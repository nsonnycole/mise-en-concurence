<?php

namespace Flair\UserBundle\Mailers;

use Flair\CoreBundle\Events\Security\MotdepasseOublieEvent;
use Flair\CoreBundle\Mailers\AbstractMailer;

class SecurityMailer extends AbstractMailer
{
    /**
     * Validation de l'adresse email de l'utilisateur.
     */
    public function sendReset(MotdepasseOublieEvent $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Reinitialisation du mot de passe')
            ->setTo($event->getUtilisateur()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairUserBundle:Mails:motdepasseOublie.html.twig',
                    array('token' => $event->getUtilisateur()->getResetToken())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairUserBundle:Mails:motdepasseOublie.txt.twig',
                    array('token' => $event->getUtilisateur()->getResetToken())
                )
            );

        $this->mailer->send($message);
    }
}
