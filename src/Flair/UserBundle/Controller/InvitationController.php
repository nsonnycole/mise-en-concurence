<?php

namespace Flair\UserBundle\Controller;

use Flair\UserBundle\Events\Invitation\RefuseInvitation;
use Flair\UserBundle\Events\Invitation\RenewInvitation;
use Flair\UserBundle\Events\InvitationEvents;
use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Model\FiltreInvitationModel;
use Flair\UserBundle\Model\InscriptionOrganisme;
use Flair\UserBundle\Model\InscriptionPrestataire;
use Flair\UserBundle\Model\Invitation as InvitationModel;
use Flair\UserBundle\Events\Invitation\NouvelleInvitation;
use Flair\UserBundle\Form\Type\InvitationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class InvitationController extends InscriptionController
{
    private function userCheckAccess()
    {
        $security = $this->get("security.authorization_checker");

        // Prestataire sans le role gestionnaire ne peut pas invité
        if (!$this->isPrestataire() && !$security->isGranted("ROLE_GESTIONNAIRE")) {
            throw new AccessDeniedException('Accès non autorisé');
        }
    }

    public function listerAction()
    {
        $this->userCheckAccess();
        // TODO add form filtre
        $invitations = $this->getRepo("FlairUserBundle:Invitation")->findInvitationByFiltreAndSender(new FiltreInvitationModel(), $this->getUser());

        return $this->render("FlairUserBundle:Invitation:lister.html.twig", array(
            'invitations' => $invitations
        ));
    }

    public function sendAction(Request $request)
    {
        $this->userCheckAccess();

        $invitation = new InvitationModel();

        $form = $this->createForm(InvitationFormType::class, $invitation);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $invitation = $invitation->toInvitation($this->getUser());

            $em = $this->getEm();
            $em->persist($invitation);
            $em->flush();

            $this->get('event_dispatcher')->dispatch(
                InvitationEvents::NEW_INVITATION,
                new NouvelleInvitation($invitation)
            );

            return $this->redirect($this->generateUrl('flair_user_invitation_list'));
        }

        return $this->render("FlairUserBundle:Invitation:inviter.html.twig", array(
            "form" => $form->createView()
        ));
    }

    public function acceptAction(Request $request, Invitation $invitation)
    {
        switch($invitation->getTypeInvitation())
        {
            case Invitation::INVIT_PRESTATAIRE:
            case Invitation::INVIT_SERVICE_PRESTATAIRE:
                return $this->inscriptionPrestataire($request, $invitation);
                break;

            case Invitation::INVIT_SERVICE_ORGANISME:
                return $this->inscriptionServiceOrganisme($request, $invitation);
                break;
        }

        // TODO Throw exception
    }

    public function renewAction(Invitation $invitation)
    {
        $this->get('event_dispatcher')->dispatch(InvitationEvents::RENEW_INVITATION, new RenewInvitation($invitation));

        $invitation->setDateInvitation(new \DateTime());
        $this->getEm()->flush();

        return $this->redirect($this->generateUrl('flair_user_invitation_list'));
    }

    public function refuseAction(Invitation $invitation)
    {
        $this->get('event_dispatcher')->dispatch(InvitationEvents::REFUSE_INVITATION, new RefuseInvitation($invitation));

        $invitation->setStatus(Invitation::REFUSED);
        $this->getEm()->flush();

        return $this->render("FlairUserBundle:Invitation:refuse.html.twig");
    }

    public function removeAction(Invitation $invitation)
    {
        $this->getEm()->remove($invitation);
        $this->getEm()->flush();

        return $this->redirect($this->generateUrl('flair_user_invitation_list'));
    }
}
