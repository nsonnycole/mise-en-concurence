<?php

namespace Flair\OrganismeBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\CoreBundle\Security\VoterPrestataire;
use Flair\UserBundle\Entity\Prestataire;
use Flair\OrganismeBundle\Form\Type\FiltrePrestataireType;
use Flair\OrganismeBundle\Model\FiltrePrestataireModel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur pour la gestion des prestataires.
 */
class PrestatairesController extends CoreController
{
    /**
     * Affiche la liste de mes prestataires.
     */
    public function listerAction(Request $request)
    {
        $filtre = new FiltrePrestataireModel();
        $form = $this->createForm(new FiltrePrestataireType(), $filtre);
        $form->handleRequest($request);

        $prestataires = $this->getDoctrine()
            ->getRepository('FlairUserBundle:Prestataire')
            ->findByFiltreAndOrganisme($filtre, $this->getUser());
        
        return $this->render('FlairOrganismeBundle:Prestataires:lister.html.twig', array(
            'prestataires' => $prestataires,
            'form'         => $form->createView()
        ));
    }

    /**
     * Affiche le prestataire.
     */
    public function afficherAction(Prestataire $prestataire)
    {
        $this->isGranted(VoterPrestataire::VIEW, $prestataire);

        return $this->render('FlairOrganismeBundle:Prestataires:afficher.html.twig', array(
            'prestataire' => $prestataire
        ));
    }

    public function supprimerPrestataireAction(Prestataire $prestataire)
    {
        $this->isGranted(VoterPrestataire::DELETE, $prestataire);

        $this->getUser()->getPrestataires()->removeElement($prestataire);

        $this->getDoctrine()->getManager()->persist($this->getUser());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('Organisme_prestataires'));
    }
}
