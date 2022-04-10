<?php

declare(strict_types=1);

use Nfw\Controller\GreetingsController;
use Nfw\Controller\LeapYearController;
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
    '_controller' => [new LeapYearController(), 'index'],
]));

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => [new GreetingsController(), 'greeting'],
]));

$routes->add('bye', new Route('/bye', [
    '_controller' => [new GreetingsController(), 'greeting'],
]));

return $routes;