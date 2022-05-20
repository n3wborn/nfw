<?php

declare(strict_types=1);

namespace Nfw\Framework\Listeners;

use Nfw\Framework\ResponseEvent;

final class ContentLengthListener
{
    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfert-Encoding')) {
            $headers->set('Content-Length', strval(strlen($response->getContent())));
        }
    }
}
