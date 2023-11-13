<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//use Symfony\WebpackEncoreBundle\EventListener\ExceptionListener;
//use Symfony\Component\Security\Http\Firewall\ExceptionListener;
//use EasyCorp\Bundle\EasyAdminBundle\EventListener\ExceptionListener;
//use App\EventListener\ExceptionListener;
//use ApiPlatform\Core\EventListener\ExceptionListener;


class ExceptionListener {
    public function onKernelException(ExceptionEvent $event) : void
    {
        if (
            $_ENV['APP_ENV'] != 'prod'
            || !$event->isMasterRequest()
            || !$event->getThrowable() instanceof NotFoundHttpException
        ) {
            return;
        }

        // Send a not found in JSON format
        $event->setResponse(new JsonResponse("$this->translator->trans('not_found')"));
    }
}