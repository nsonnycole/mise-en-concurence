<?php

namespace Flair\PrestataireBundle\Controller;

use Flair\CoreBundle\Entity\Question;
use Flair\CoreBundle\Entity\Reponse;
use Flair\CoreBundle\Events\Question\NewQuestionEvent;
use Flair\CoreBundle\Events\QuestionEvents;
use Flair\PrestataireBundle\Form\Type\QuestionFormType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controlleur des questions sur une consultation.
 */
class QuestionsController extends Controller
{
    /**
     * Affiche la question et la reponse.
     *
     * @Template
     */
    public function afficherAction(Question $question)
    {
        return array(
            'question' => $question
        );
    }

    /**
     * @Template
     */
    public function listerAction(Reponse $reponse)
    {
        return array(
            "questions" => $reponse->getQuestions(),
            "reponse" => $reponse
        );
    }

    /**
     * Permets de poser une question.
     *
     * @Template
     */
    public function poserAction(Reponse $reponse, Request $request)
    {
        $question = new Question();
        $form = $this->createForm(new QuestionFormType(), $question);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $question->setReponse($reponse);

            $this->getDoctrine()->getManager()->persist($question);
            $this->getDoctrine()->getManager()->flush();

            $this->get('event_dispatcher')->dispatch(QuestionEvents::NEW_QUESTION, new NewQuestionEvent($question));

            return $this->redirect(
                $this->generateUrl('Prestataire_propositions_afficher', array('id' => $reponse->getId()))
            );
        }

        return array(
            'reponse' => $reponse,
            'form'    => $form->createView()
        );
    }
}
