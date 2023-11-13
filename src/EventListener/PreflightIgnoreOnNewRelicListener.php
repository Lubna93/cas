<?php

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
// use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PreflightIgnoreOnNewRelicListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!extension_loaded('newrelic')) {
            return;
        }

        if ('OPTIONS' === $event->getRequest()->getMethod()) {
            newrelic_ignore_transaction();
        }
    }
}