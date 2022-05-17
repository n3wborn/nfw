<?php

declare(strict_types=1);

namespace Nfw\Framework;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ResponseEvent extends EventDispatcher
{
    public function __construct(
        private Request $request,
        private Response $response
    ) {
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
