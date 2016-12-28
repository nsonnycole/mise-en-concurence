<?php

namespace Flair\CoreBundle\Events;

class QuestionEvents
{
    /**
     * @const String Une question a été posé par un prestataire.
     */
    const NEW_QUESTION = 'flair.event.question.new_question';

    /**
     * @const String Une reponse a été apporté par l'organisme.
     */
    const NEW_ANSWER = 'flair.event.question.new_answer';
}
