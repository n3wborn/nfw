<?php

declare(strict_types=1);

require_once __DIR__.'/../../vendor/autoload.php';

use Nfw\Controller\RouteController;
use Nfw\Framework\Framework;
use Nfw\Framework\Listeners\ContentLengthListener;
use Nfw\Framework\Listeners\GoogleListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;

/*
 * contrary to the way it's done in the doc
 * (https://symfony.com/doc/current/create_framework/front_controller.html)
 * we use index.php as the front controller
 */

$dispatcher = new EventDispatcher();
$dispatcher->addListener('NfwEvent', [new GoogleListener(), 'onResponse']);
$dispatcher->addListener('NfwEvent', [new ContentLengthListener(), 'onResponse'], -255);

$request = Request::createFromGlobals();
$routes = (new RouteController())->route();

$context = (new Routing\RequestContext())->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
