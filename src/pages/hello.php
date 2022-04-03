<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;

$name = $request->query->get('name', 'World');

$response = new Response(sprintf('Hello %s', htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));
