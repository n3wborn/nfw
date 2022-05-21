<?php

declare(strict_types=1);

namespace Nfw\Framework\Listeners;

use Nfw\Framework\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class GoogleListener implements EventSubscriberInterface
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

    public static function getSubscribedEvents(): array | object
    {
        return ['NfwEvent' => 'onResponse'];
    }
}
