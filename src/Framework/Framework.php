<?php

declare(strict_types=1);

namespace Nfw\Framework;

use Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

final class Framework
{
    public function __construct(
        private EventDispatcherInterface $dispatcher,
        private UrlMatcherInterface $matcher,
        private ControllerResolverInterface $controllerResolver,
        private ArgumentResolverInterface $argumentResolver
    ) {
    }

    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            $response = new Response('Not Found', 404);
        } catch (Exception $exception) {
            $response = new Response('An error occured', 500);
        }

        $this->dispatcher->dispatch(new ResponseEvent($request, $response), 'NfwEvent');

        return $response;
    }
}
