<?php

namespace Flair\CoreBundle\Events\Question;

use Flair\CoreBundle\Entity\Question;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class NewAnswerEvent
 * @package Flair\CoreBundle\Events\Question
 */
class NewAnswerEvent extends Event
{
    /**
     * @var Question
     */
    private $question;

    /**
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @param \Flair\CoreBundle\Entity\Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return \Flair\CoreBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
