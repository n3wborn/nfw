<?php

declare(strict_types=1);

namespace Nfw\Framework\Listeners;

use Nfw\Framework\ResponseEvent;

final class GoogleListener
{
    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        if ($response->isRedirection()
        || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
        || 'html' !== $event->getRequest()->getRequestFormat()
    ) {
            return;
        }

        $response->setContent($response->getContent().' GA CODE');
    }
}
