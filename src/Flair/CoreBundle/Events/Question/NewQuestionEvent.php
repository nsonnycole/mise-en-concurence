<?php

namespace Flair\CoreBundle\Events\Question;

use Flair\CoreBundle\Entity\Question;
use Symfony\Component\EventDispatcher\Event;

/**
 * Une nouvelle question a été posée.
 */
class NewQuestionEvent extends Event
{
    /**
     * @var Question La question qui a été posée.
     */
    private $question;

    /**
     * Initialisation de la question.
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
