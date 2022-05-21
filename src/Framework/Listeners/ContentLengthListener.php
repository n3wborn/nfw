<?php

declare(strict_types=1);

namespace Nfw\Framework\Listeners;

use Nfw\Framework\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ContentLengthListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfert-Encoding')) {
            $headers->set('Content-Length', strval(strlen($response->getContent())));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return ['response' => ['onResponse'], -255];
    }
}
