<?php

declare(strict_types=1);

require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

/*
 * contrary to the way it's done in the doc
 * (https://symfony.com/doc/current/create_framework/front_controller.html)
 * we use index.php as the front controller
 */

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../../src/app.php';

$context = (new Routing\RequestContext())->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../../src/pages/%s.php', $_route);

    $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();
