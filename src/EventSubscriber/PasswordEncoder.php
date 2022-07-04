<?php
// api/src/EventSubscriber/BookMailSubscriber.php

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Collecteur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


final class PasswordEncoder implements EventSubscriberInterface
{
    /** @var  UserPasswordEncoderInterface  */

    private $encoder;

    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE],
            KernelEvents::VIEW => ['encodePasswordCollecteur', EventPriorities::PRE_WRITE],
        ];
    }

    public function encodePassword(ViewEvent $event): void
    {
        $utilisateur = $event->getControllerResult();
        // dd($utilisateur);
        $method = $event->getRequest()->getMethod();

        if ($utilisateur instanceof Utilisateur  && $method  === Request::METHOD_POST) {
            $hash = $this->encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($hash);
        }
    }
    public function encodePasswordCollecteur(ViewEvent $event): void
    {
        $collecteur = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($collecteur instanceof Collecteur  && $method  === Request::METHOD_POST) {
            $hash = $this->encoder->encodePassword($collecteur, $collecteur->getPassword());
            $collecteur->setPassword($hash);
        }
    }
}