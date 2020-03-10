<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if ('json' === $request->getContentType()) {
            $content = null !== ($data = \json_decode($request->getContent(), true))
                ? $data
                : []
            ;

            $request->request->replace($content);
        }
    }
}
