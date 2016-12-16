<?php

namespace Flair\UserBundle\Mailers;

use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Events\Invitation\InvitationAccepte;
use Flair\UserBundle\Events\Invitation\NouvelleInvitation;
use Flair\UserBundle\Events\Invitation\RefuseInvitation;
use Flair\UserBundle\Events\Invitation\RenewInvitation;
use Flair\CoreBundle\Mailers\AbstractMailer;

/**
 * Mailer de gestion des invitations.
 */
class InvitationMailer extends AbstractMailer
{
    /**
     * Envoi l'invitation a l'utilisateur selectionné
     */
    public function sendInvitation(NouvelleInvitation $event)
    {
        $templates = $this->getTemplates($event);

        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Invitation reçue')
            ->setTo($event->getInvitation()->getEmail())
            ->setBody(
                $this->templating->render(
                    $templates["html"],
                    array('invitation' => $event->getInvitation())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    $templates["txt"],
                    array('invitation' => $event->getInvitation())
                )
            );

        $this->mailer->send($message);
    }

    /**
     * Renvoi l'invitation a l'utilisateur selectionné
     */
    public function sendRelance(RenewInvitation $event)
    {
        $templates = $this->getTemplates($event, "Relance");

        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Invitation reçue')
            ->setTo($event->getInvitation()->getEmail())
            ->setBody(
                $this->templating->render(
                    $templates["html"],
                    array('invitation' => $event->getInvitation())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    $templates["txt"],
                    array('invitation' => $event->getInvitation())
                )
            );

        $this->mailer->send($message);
    }

    /**
     * @param InvitationAccepte $event
     */
    public function sendBienvenue(InvitationAccepte $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Bienvenue')
            ->setTo($event->getReceiver()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationBienvenue.html.twig',
                    array(
                        'receiver' => $event->getReceiver()
                    )
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationBienvenue.txt.twig',
                    array(
                        'receiver' => $event->getReceiver()
                    )
                )
            );

        $this->mailer->send($message);
    }

    /**
     * L'utilisateur a accepté l'invitation.
     */
    public function sendConfirmation(InvitationAccepte $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Votre invitation a été accepté')
            ->setTo($event->getSender()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationAccepte.html.twig',
                    array('receiver' => $event->getReceiver())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationAccepte.txt.twig',
                    array('receiver' => $event->getReceiver())
                )
            );

        $this->mailer->send($message);
    }

    public function sendRefuse(RefuseInvitation $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Votre invitation a été refusé')
            ->setTo($event->getInvitation()->getSender()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationRefuse.html.twig',
                    array('receiver' => $event->getInvitation()->getReceiver())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairUserBundle:Mails:invitationRefuse.txt.twig',
                    array('receiver' => $event->getInvitation()->getReceiver())
                )
            );

        $this->mailer->send($message);
    }

    private function getTemplates($nouvelleInvitation, $suffixe = "")
    {
        $invitation = $nouvelleInvitation->getInvitation();

        if (Invitation::INVIT_PRESTATAIRE == $invitation->getTypeInvitation())
        {
            return array(
                "html" => "FlairUserBundle:Mails:invitation" . $suffixe . ".html.twig",
                "txt" => "FlairUserBundle:Mails:invitation" . $suffixe . ".txt.twig",
            );
        }
        else if (Invitation::INVIT_SERVICE_ORGANISME == $invitation->getTypeInvitation() ||
                Invitation::INVIT_SERVICE_PRESTATAIRE == $invitation->getTypeInvitation())
        {
            return array(
                "html" => "FlairUserBundle:Mails:invitationService" . $suffixe . ".html.twig",
                "txt" => "FlairUserBundle:Mails:invitationService" . $suffixe . ".txt.twig",
            );
        }
        else {
            throw new \Exception("Type invitation is not managed");
        }
    }
}
