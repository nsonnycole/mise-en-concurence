<?php

namespace Flair\CoreBundle\Mailers;

use Flair\CoreBundle\Events\Question\NewAnswerEvent;
use Flair\CoreBundle\Events\Question\NewQuestionEvent;

/**
 * Envoie de notifications liées aux questions.
 */
class QuestionMailer extends AbstractMailer
{
    /**
     * Envoi d'une notification à l'organisme pour signaler qu'une nouvelle question a été posée.
     */
    public function sendNewQuestion(NewQuestionEvent $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Une question vous a été posée')
            ->setTo($event->getQuestion()->getReponse()->getConsultation()->getOrganisme()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairCoreBundle:Mails:questionNewQuestion.html.twig',
                    array('question' => $event->getQuestion())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairCoreBundle:Mails:questionNewQuestion.txt.twig',
                    array('question' => $event->getQuestion())
                )
            );

        $this->mailer->send($message);
    }

    /**
     * Envoi d'une notification à l'organisme pour signaler qu'une nouvelle question a été posée.
     */
    public function sendNewAnswer(NewAnswerEvent $event)
    {
        $message = $this->buildNewMessage()
            ->setSubject('Mise-en-concurrence - Une réponse à votre question!')
            ->setTo($event->getQuestion()->getReponse()->getConsultation()->getOrganisme()->getEmail())
            ->setBody(
                $this->templating->render(
                    'FlairCoreBundle:Mails:questionNewAnswer.html.twig',
                    array('question' => $event->getQuestion())
                ),
                'text/html'
            )
            ->addPart(
                $this->templating->render(
                    'FlairCoreBundle:Mails:questionNewAnswer.txt.twig',
                    array('question' => $event->getQuestion())
                )
            );

        $this->mailer->send($message);
    }
}
