<?php

declare(strict_types=1);

require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/*
 * contrary to the way it's done in the doc
 * (https://symfony.com/doc/current/create_framework/front_controller.html)
 * we use index.php as the front controller
 */

$request = Request::createFromGlobals();

$map = [
    '/hello' => 'hello',
    '/bye' => 'bye',
];

$path = $request->getPathInfo();

if (isset($map[$path])) {
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf(__DIR__.'/../pages/%s.php', $map[$path]);
    $response = new Response(ob_get_clean());
} else {
    $response = new Response('Not Found', 404);
}

$response->send();
