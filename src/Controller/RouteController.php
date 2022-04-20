<?php

declare(strict_types=1);

namespace Nfw\Controller;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

final class RouteController
{
    public function route(): RouteCollection
    {
        $routes = new RouteCollection();

        $routes->add('is_leap_year', new Route('/is_leap_year/{year}', [
            'year' => null,
            '_controller' => 'Nfw\Calendar\Controller\LeapYearController::index',
        ]));

        return $routes;
    }
}
