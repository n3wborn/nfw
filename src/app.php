<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => function (Request $request) {
        $response = render_template($request);

        $response->headers->set('Content-type', 'text/plain');

        return $response;
    },
]));

$routes->add('bye', new Routing\Route('/bye', [
    '_controller' => function (Request $request) {
        $response = render_template($request);

        $response->headers->set('Content-type', 'text/plain');

        return $response;
    },
]));

return $routes;
