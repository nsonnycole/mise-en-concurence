<?php

namespace Flair\CoreBundle\Mailers;

use Flair\CoreBundle\Events\Consultation\AnnulationConsultationEvent;
use Flair\CoreBundle\Events\Consultation\ConsultationFinishedEvent;
use Flair\CoreBundle\Events\Consultation\ConsultationStartedEvent;
use Flair\CoreBundle\Events\Consultation\DiffusionConsultationEvent;
use Flair\CoreBundle\Events\Consultation\NewReponseConsultationEvent;
use Flair\CoreBundle\Events\Consultation\PrestationStartedEvent;
use Flair\CoreBundle\Events\Consultation\ReponseSelectedEvent;

/**
 * Emailing en rapport avec les consultations.
 */
class ConsultationMailer extends AbstractMailer
{
    /**
     * @param DiffusionConsultationEvent $event
     */
    public function sendDiffusion(DiffusionConsultationEvent $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Invitation à une mise en concurrence')
            ->setTo($event->getPrestataire()->getEmail())
            ->addBcc($event->getConsultation()->getOrganisme()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationDiffusion.html.twig',
                    array(
                        'consultation' => $event->getConsultation(),
                        'reponse'      => $event->getReponse()
                    )
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationDiffusion.txt.twig',
                    array(
                        'consultation' => $event->getConsultation(),
                        'reponse'      => $event->getReponse()
                    )
                )
            );

        $this->mailer->send($message);
    }

    /**
     * Expedition d'un mail à chaque prestataire invité à la consultation.
     */
    public function sendAnnulation(AnnulationConsultationEvent $event)
    {
        foreach ($event->getConsultation()->getReponses() as $reponse) {

            $message = $this->buildNewMessage()
                ->setSubject(
                    'Mise-en-concurrence - Annulation de la mise en concurrence : ' .
                    $event->getConsultation()->getTitre()
                )
                ->setTo($reponse->getPrestataire()->getEmail())
                ->setBody(
                    $this->templating->render(
                        'FlairCoreBundle:Mails:consultationAnnulation.html.twig',
                        array('consultation' => $event->getConsultation())
                    ),
                    'text/html'
                )
                ->addPart(
                    $this->templating->render(
                        'FlairCoreBundle:Mails:consultationAnnulation.txt.twig',
                        array('consultation' => $event->getConsultation())
                    )
                );

            $this->mailer->send($message);
        }
    }

    /**
     * Une nouvelle reponse est disponible.
     */
    public function sendNewReponse(NewReponseConsultationEvent $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Une nouvelle reponse à votre demande est disponible')
            ->setTo($event->getReponse()->getConsultation()->getOrganisme()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationNewReponse.html.twig',
                    array('reponse' => $event->getReponse())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationNewReponse.txt.twig',
                    array('reponse' => $event->getReponse())
                )
            );

        $this->mailer->send($message);
    }

    /**
     * Envoi un email aux differents prestataires.
     */
    public function sendReponseSelected(ReponseSelectedEvent $event)
    {
        foreach ($event->getConsultation()->getReponses() as $reponse) {
            if ($reponse != $event->getConsultation()->getReponseSelectionne()) {

                $message = $this->buildNewMessage()
                    ->setSubject('Mise-en-concurrence - Votre proposition n\'a pas été retenue')
                    ->setTo($reponse->getPrestataire()->getEmail())
                    ->setBody(
                        $this->templating->render(
                            'FlairCoreBundle:Mails:consultationReponseSelectedDecline.html.twig',
                            array('consultation' => $reponse->getConsultation())
                        ),
                        'text/html'
                    )
                    ->addPart(
                        $this->templating->render(
                            'FlairCoreBundle:Mails:consultationReponseSelectedDecline.txt.twig',
                            array('consultation' => $reponse->getConsultation())
                        )
                    );

                $this->mailer->send($message);

            }
        }

        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Votre proposition a été retenue')
            ->setTo($event->getConsultation()->getReponseSelectionne()->getPrestataire()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationReponseAccepte.html.twig',
                    array('reponse' => $event->getConsultation()->getReponseSelectionne())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairCoreBundle:Mails:consultationReponseAccepte.txt.twig',
                    array('reponse' => $event->getConsultation()->getReponseSelectionne())
                )
            );

        $this->mailer->send($message);
    }
}
