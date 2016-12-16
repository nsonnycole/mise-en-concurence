<?php

namespace Flair\UserBundle\Mailers;

use Flair\UserBundle\Events\Inscription\ConfirmationEmail;
use Flair\CoreBundle\Mailers\AbstractMailer;

/**
 * Mailer de l'inscription.
 */
class InscriptionMailer extends AbstractMailer
{
    /**
     * Validation de l'adresse email de l'utilisateur.
     */
    public function sendConfirmation(ConfirmationEmail $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Inscription sur Mise-en-Concurrence.com')
            ->setTo($event->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairUserBundle:Mails:confirmationEmail.html.twig',
                    array('tokenUrl' => $event->getToken())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairUserBundle:Mails:confirmationEmail.txt.twig',
                    array('tokenUrl' => $event->getToken())
                )
            );

        $this->mailer->send($message);
    }
}
