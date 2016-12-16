<?php

namespace Flair\CoreBundle\Handlers;


use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Va modifier la réponse envoyé par l'application pour desactiver le cache.
 */
class NoCacheResponseHandler
{
    /**
     * Ajout de headers dans la réponse pour éviter le rechargement directement depuis le cache avec le bouton "back".
     */
    public function setNoCache(FilterResponseEvent $event)
    {
        $event->getResponse()->isCacheable(false);
        $event->getResponse()->setMaxAge(0);
        $event->getResponse()->mustRevalidate();
    }
}
