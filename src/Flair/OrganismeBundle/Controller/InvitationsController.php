<?php

namespace Flair\OrganismeBundle\Controller;

use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Events\Invitation\NouvelleInvitation;
use Flair\UserBundle\Events\Invitation\RenewInvitation;
use Flair\UserBundle\Events\InvitationEvents;
use Flair\UserBundle\Form\Type\InvitationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur de gestion des invitations pour un organisme.
 */
class InvitationsController extends Controller
{
    /**
     * Envoi d'une invitation à un prestataire à rejoindre MeC.
     */
    public function inviterAction(Request $request)
    {
        $invitation = new Invitation();
        $invitation->setSender($this->getUser());
        $invitation->setTypeInvitation(Invitation::INVIT_PRESTATAIRE);

        $form = $this->createForm(new InvitationFormType(), $invitation);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($invitation);
            $this->getDoctrine()->getManager()->flush();

            // Envoyer l'email
            $this->get('event_dispatcher')->dispatch(
                InvitationEvents::NEW_INVITATION,
                new NouvelleInvitation($invitation)
            );

            return $this->redirect($this->generateUrl('Organisme_prestataires'));
        }

        return $this->render('FlairUserBundle:Invitation:inviter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Relance l'invitation pour un prestataire.
     */
    public function relancerAction(Invitation $invitation)
    {
        $this->get('event_dispatcher')->dispatch(InvitationEvents::RENEW_INVITATION, new RenewInvitation($invitation));

        $invitation->setDateInvitation(new \DateTime());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('Organisme_prestataires'));
    }

    /**
     * Suppression d'une invitation.
     */
    public function supprimerAction(Invitation $invitation)
    {
        $this->getDoctrine()->getManager()->remove($invitation);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('Organisme_prestataires'));
    }

    /**
     * Envoi d'une invitation à un service de son entreprise à rejoindre MeC
     */
    public function inviterServiceAction(Request $request)
    {
        $invitation = new Invitation();
        $invitation->setOrganisme($this->getUser());
        $invitation->setTypeInvitation(Invitation::INVITATION_SERVICE);

        $form = $this->createForm(new InvitationFormType(), $invitation);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($invitation);
            $this->getDoctrine()->getManager()->flush();

            // Envoyer l'email
            $this->get('event_dispatcher')->dispatch(
                InvitationEvents::NEW_INVITATION,
                new NouvelleInvitation($invitation)
            );

            return $this->redirect($this->generateUrl('Organisme_services'));
        }

        return $this->render('FlairOrganismeBundle:Invitations:inviterService.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
