<?php

declare(strict_types=1);

namespace Nfw\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GreetingsController
{
    public function greeting(Request $request): Response
    {
        $response = render_template($request);

        $response->headers->set('Content-type', 'text/plain');

        return $response;
    }
}
