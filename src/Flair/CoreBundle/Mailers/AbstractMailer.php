<?php

namespace Flair\CoreBundle\Mailers;

/**
 * Service mailer avec les valeurs par defaut.
 */
abstract class AbstractMailer
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @return \Swift_Message
     */
    public function buildNewMessage()
    {
        $message = \Swift_Message::newInstance();
        $message->setFrom('contact@mise-en-concurrence.fr');
        $message->setBcc('efroideval@gmail.com');

        return $message;
    }

    /**
     * @param \Swift_Mailer $mailer
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param \Symfony\Bundle\TwigBundle\TwigEngine $templating
     */
    public function setTemplating($templating)
    {
        $this->templating = $templating;
    }
}
