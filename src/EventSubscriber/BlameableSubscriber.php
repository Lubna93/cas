<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\Comment;
use App\Entity\User;

use Symfony\Component\Security\Core\Security;

class BlameableSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function onBeforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event): void
    {
        // $comment = $event->getEntityInstance();
        // if (!$comment instanceof Comment) {
        //     return;
        // }

        // $user = $this->security->getUser();
        // // We always should have a User object in EA
        // if (!$user instanceof User) {
        //     throw new \LogicException('Currently logged in user is not an instance of User?!');
        // }

        // $comment->setAccount($user);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            //BeforeEntityUpdatedEvent::class => 'onBeforeEntityUpdatedEvent',
        ];
    }
}
