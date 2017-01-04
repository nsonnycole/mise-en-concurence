<?php

namespace Flair\UserBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Entreprise;
use Flair\UserBundle\Entity\Invitation;
use Flair\UserBundle\Entity\Prestataire;
use Flair\UserBundle\Events\Invitation\InvitationAccepte;
use Flair\UserBundle\Events\InvitationEvents;
use Flair\UserBundle\Form\Type\InscriptionServiceOrganismeType;
use Flair\CoreBundle\Entity\Tag;
use Flair\UserBundle\Form\Type\InscriptionServicePrestataireType;
use Flair\UserBundle\Model\InscriptionOrganisme;
use Flair\UserBundle\Form\Type\InscriptionOrganismeType;
use Flair\UserBundle\Events\InscriptionEvents;
use Flair\UserBundle\Events\Inscription\ConfirmationEmail;
use Flair\UserBundle\Model\InscriptionPrestataire;
use Flair\UserBundle\Form\Type\InscriptionPrestataireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class InscriptionController extends CoreController
{
    public function inscriptionOrganismeAction(Request $request)
    {
        $organisme = new InscriptionOrganisme();
        $form = $this->createForm(InscriptionOrganismeType::class, $organisme);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            if ($this->sirenAlreadyExist($organisme->getSiren())) {
                return $this->sirenExist($this->findGestionnaire($organisme->getSiren()));
            }

            // Conversion du model vers l'entité
            $organisme = $organisme->toOrganisme();
            $organisme->addRole("ROLE_GESTIONNAIRE");

            $password = $this->encryptPassword($organisme, $organisme->getPassword(), $organisme->getSalt());
            $organisme->setPassword($password);

            $em = $this->getEm();
            $em->persist($organisme);
            $em->flush();

            $this->sendConfirmationEmail($organisme);

            return $this->render('FlairUserBundle:Inscription:inscriptionSuccess.html.twig');
        }

        return $this->render('FlairUserBundle:Inscription:inscriptionOrganisme.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function inscriptionPrestataire(Request $request, Invitation $invitation)
    {
        $inscriptionPrestataire = new InscriptionPrestataire();

        $inscriptionPrestataire->fromInvitation($invitation);

        $form = $this->createForm(InscriptionPrestataireType::class, $inscriptionPrestataire);
        $form->handleRequest($request);
        $tags = $request->get('tagList');
        
        if ($form->isValid())
        {
            $invitation->setStatus(Invitation::ACCEPTED);

            if ($invitation->getTypeInvitation() == Invitation::INVIT_PRESTATAIRE)
            {
                $prestataire = $inscriptionPrestataire->toPrestataire();
                $prestataire->addRole("ROLE_GESTIONNAIRE");
                $invitation->getSender()->getPrestataires()->add($prestataire);

                if ($this->sirenAlreadyExist($prestataire->getSiren())) {
                    return $this->sirenExist($this->findGestionnaire($prestataire->getSiren()));
                }
            }
            else {
                $prestataire = $inscriptionPrestataire->toService($invitation->getSender());
            }

            // Transformation du model en entité.
            $prestataire->setEmailValide(true);

            $password = $this->encryptPassword($prestataire, $prestataire->getPassword(), $prestataire->getSalt());
            $prestataire->setPassword($password);


            // Enregistrement du prestataire
            $this->getEm()->persist($prestataire);
            $this->getEm()->remove($invitation);
            $this->getEm()->flush();

            if (!is_null($tags) && sizeof($tags) > 0) {
                $tags = explode(',', $tags);

                foreach ($tags as $tag) {
                    $t = $this->getDoctrine()->getRepository('FlairCoreBundle:Tag')->findOneByName($tag);

                    if (is_null($t)) {
                        $newTag = new Tag();
                        $newTag->setName($tag);
                        $this->getDoctrine()->getManager()->persist($newTag);
                        $this->getDoctrine()->getManager()->flush();
                        $prestataire->addTag($newTag);
                    } else {
                        $prestataire->addTag($t);
                    }
                }
            }

            $this->getDoctrine()->getManager()->persist($prestataire);
            $this->getDoctrine()->getManager()->flush();

            $this->sendConfirmationEmail($prestataire);

            // And redirect vers la page des consultations.
            return $this->render('FlairUserBundle:Inscription:inscriptionSuccess.html.twig');
        }

        return $this->render('FlairUserBundle:Inscription:inscriptionPrestataire.html.twig', array(
            'form'  => $form->createView(),
            'token' => (!is_null($invitation)) ? $invitation->getToken() : null,
            'tags'  => !is_null($tags) ? explode(',', $tags) : null
        ));
    }

    public function inscriptionServiceOrganisme(Request $request, Invitation $invitation)
    {
        $organisme = new InscriptionOrganisme();
        $organisme->setSiren($invitation->getSender()->getSiren());
        $organisme->setEmail($invitation->getEmail());
        $form = $this->createForm(InscriptionServiceOrganismeType::class, $organisme);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $invitation->setStatus(Invitation::ACCEPTED);
            $organisme = $organisme->toService($invitation->getSender());

            $password = $this->encryptPassword($organisme, $organisme->getPassword(), $organisme->getSalt());
            $organisme->setPassword($password);

            $this->getEm()->persist($organisme);
            $this->getEm()->flush();

            $this->sendConfirmationEmail($organisme);

            // Dispatch du mail
            $this->get('event_dispatcher')->dispatch(
                InvitationEvents::INVITATION_ACCEPTED,
                new InvitationAccepte($organisme, $invitation->getSender())
            );

            // And redirect vers la page des consultations.
            return $this->render('FlairUserBundle:Inscription:inscriptionSuccess.html.twig');
        }

        return $this->render('FlairUserBundle:Inscription:inscriptionOrganisme.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function confirmationEmailAction(AbstractUtilisateur $user, Request $request)
    {
        $user->setToken(null);
        $user->setEmailValide(true);
        $this->getEm()->flush();

        // Login de l'utilisateur
        $token = new UsernamePasswordToken(
            $user,
            $user->getPassword(),
            "application",
            $user->getRoles()
        );

        $this->get("security.context")->setToken($token);

        // Fire the login event
        // Logging the user in above the way we do it doesn't do this automatically
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        return $this->redirect($this->generateUrl('Homepage'));
    }

    private function sendConfirmationEmail(AbstractUtilisateur $user)
    {
        $this->get('event_dispatcher')->dispatch(
            InscriptionEvents::EMAIL_CONFIRMATION,
            new ConfirmationEmail($user->getToken(), $user->getEmail())
        );
    }

    private function findGestionnaire($siren)
    {
        $services = $this->getRepo("FlairUserBundle:Organisme")->findGestionnaire($siren);

        foreach($services as $service)
        {
            if ($service->hasRole("ROLE_GESTIONNAIRE")) {
                return $service;
            }
        }

        $services = $this->getRepo("FlairUserBundle:Prestataire")->findGestionnaire($siren);

        foreach($services as $service)
        {
            if ($service->hasRole("ROLE_GESTIONNAIRE")) {
                return $service;
            }
        }

        return null;
    }

    private function sirenAlreadyExist($siren)
    {
        $entreprise = $this->getRepo("FlairUserBundle:Entreprise")->findBy(array("siren" => $siren));

        return !empty($entreprise);
    }

    private function sirenExist($gestionnaire)
    {
        return $this->render("FlairUserBundle:Inscription:sirenAlreadyExist.html.twig", array(
            "gestionnaire" => $gestionnaire
        ));
    }
}
