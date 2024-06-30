<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;

class SessionIdleTimeoutListener
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $session = $request->getSession();
        $idleTimeout = $session->get('_security.main.idle_timeout');

        if ($idleTimeout && time() > $idleTimeout) {
            $session->invalidate();
            $event->setResponse(new RedirectResponse($this->router->generate('app_login')));
        }
    }
}
