<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

function is_leap_year(?string $year = null): bool
{
    $year ??= intval(date('Y'));

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

$routes = new RouteCollection();

$routes->add('is_leap_year', new Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => function (Request $request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yeap, this is a leap year');
        }

        return new Response('Nope, this is not a leap year');
    },
]));

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => function (Request $request) {
        $response = render_template($request);

        $response->headers->set('Content-type', 'text/plain');

        return $response;
    },
]));

$routes->add('bye', new Route('/bye', [
    '_controller' => function (Request $request) {
        $response = render_template($request);

        $response->headers->set('Content-type', 'text/plain');

        return $response;
    },
]));

return $routes;
