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
$response = new Response();

$map = [
    '/hello' => __DIR__.'/../pages/hello.php',
    '/bye' => __DIR__.'/../pages/bye.php',
];

$path = $request->getPathInfo();

if (isset($map[$path])) {
    require $map[$path];
} else {
    $response->setStatusCode(404);
    $response->setContent('Not found');
}

$response->send();
