<?php

namespace App\EventSubscriber;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Administrateur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


final class PasswordEncoderAdmin implements EventSubscriberInterface
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

            KernelEvents::VIEW => ['encodePasswordAdmin', EventPriorities::PRE_WRITE]
        ];
    }



    public function encodePasswordAdmin(ViewEvent $event): void
    {
        $admin = $event->getControllerResult();

        $method = $event->getRequest()->getMethod();

        if ($admin instanceof Administrateur  && $method  === Request::METHOD_POST) {
            $hash = $this->encoder->encodePassword($admin, $admin->getPassword());
            $admin->setPassword($hash);
            dd($admin);
        }
    }
}