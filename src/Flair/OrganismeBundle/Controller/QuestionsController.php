<?php

namespace Flair\OrganismeBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\CoreBundle\Entity\Consultation;
use Flair\CoreBundle\Entity\Question;

use Flair\CoreBundle\Events\Question\NewAnswerEvent;
use Flair\CoreBundle\Events\QuestionEvents;
use Flair\CoreBundle\Security\VoterConsultation;
use Flair\OrganismeBundle\Form\Type\ReponseQuestionType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Affichage des questions pour l'organisme.
 */
class QuestionsController extends CoreController
{
    /**
     * Affiche les questions relatives à cette consultation.
     *
     * @Template
     */
    public function listerAction(Consultation $consultation)
    {
        //$this->isGranted(VoterConsultation::VIEW, $consultation);

        $questions = $this->getDoctrine()
            ->getRepository('FlairCoreBundle:Question')
            ->findForConsultation($consultation);

        return array(
            'questions'    => $questions,
            'consultation' => $consultation
        );
    }

    /**
     * Affiche la question.
     *
     * @Template
     */
    public function afficherAction(Question $question, Request $request)
    {
        $form = $this->createForm(new ReponseQuestionType(), $question);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $question->setDateReponse(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            $this->get('event_dispatcher')->dispatch(QuestionEvents::NEW_ANSWER, new NewAnswerEvent($question));
        }

        return array(
            'consultation' => $question->getReponse()->getConsultation(),
            'question'     => $question,
            'form'         => $form->createView()
        );
    }
}
