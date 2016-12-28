<?php

namespace Flair\OrganismeBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\CoreBundle\Entity\Consultation;
use Flair\CoreBundle\Entity\Reponse;
use Flair\CoreBundle\Events\Consultation\ReponseSelectedEvent;
use Flair\CoreBundle\Events\ConsultationEvents;
use Flair\CoreBundle\Security\VoterConsultation;


/**
 * Controlleur pour la gestion des réponses.
 */
class ReponsesController extends CoreController
{
    /**
     * Affiche la liste des réponses.
     */
    public function listerAction(Consultation $consultation)
    {
        //$this->isGranted(VoterConsultation::VIEW, $consultation);

        $reponses = $consultation->getReponses();

        return $this->render('FlairOrganismeBundle:Reponses:lister.html.twig', array(
            'consultation' => $consultation,
            'reponses'     => $reponses
        ));
    }

    /**
     * Affiche la liste des réponses.
     */
    public function listerEmbeddedAction(Consultation $consultation)
    {
        //$this->isGranted(VoterConsultation::VIEW, $consultation);

        $reponses = $consultation->getReponses();

        return $this->render('FlairOrganismeBundle:Reponses:listerEmbedded.html.twig', array(
            'reponses' => $reponses
        ));
    }

    /**
     * Affiche la reponse de l'entreprise.
     */
    public function afficherAction(Reponse $reponse)
    {
        return $this->render('FlairOrganismeBundle:Reponses:afficher.html.twig', array(
            'reponse' => $reponse
        ));
    }

    /**
     * Selectionne la reponse.
     */
    public function selectionnerPostAction(Reponse $reponse)
    {
        $reponse->getConsultation()->setReponseSelectionne($reponse);
        $reponse->getConsultation()->setStatut(Consultation::SELECTED);
        $this->getDoctrine()->getManager()->flush();

        $this->get('event_dispatcher')->dispatch(
            ConsultationEvents::REPONSE_SELECTED,
            new ReponseSelectedEvent($reponse->getConsultation())
        );

        $this->get('session')->getFlashBag()->add(
            'success',
            'Le prestataire a bien été sélectionné, un email d\'information vient de lui être envoyé. Il doit ' .
            'vous contacter pour débuter la prestation.'
        );

        return $this->redirect($this->generateUrl('Organisme_consultations'));
    }
}
