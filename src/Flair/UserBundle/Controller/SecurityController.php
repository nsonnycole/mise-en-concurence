<?php

namespace Flair\UserBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\UserBundle\Events\Security\MotdepasseOublieEvent;
use Flair\UserBundle\Events\SecurityEvents;
use Flair\UserBundle\Form\Type\MotdepasseOublieType;
use Flair\UserBundle\Model\Motdepasse;
use Flair\UserBundle\Model\MotdepasseOublie;
use Flair\OrganismeBundle\Form\Type\MotdepasseType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Gestion de la sécurité : inscription, login, logout.
 */
class SecurityController extends CoreController
{
    /**
     * Affiche la page d'accueil.
     */
    public function loginAction(Request $request)
    {
        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $request->getSession()->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }

        return $this->render('FlairUserBundle:Security:login.html.twig', array(
            'last_username' => $request->getSession()->get(SecurityContextInterface::LAST_USERNAME),
            'error'         => $error
        ));
    }

    /**
     * Affiche la page de mot de passe oublie pour l'utilisateur.
     */
    public function motdepasseOublieAction(Request $request)
    {
        $demande = new MotdepasseOublie();
        $form = $this->createForm(new MotdepasseOublieType(), $demande);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $utilisateur = $this->getRepo('FlairUserBundle:AbstractUtilisateur')->findOneBy(
                array('email' => $demande->getEmail())
            );

            $utilisateur->setResetToken(hash('sha512', uniqid(null, true)));
            $utilisateur->setResetDate(new \DateTime());

            $this->get('event_dispatcher')->dispatch(
                SecurityEvents::MOTDEPASSE_OUBLIE,
                new MotdepasseOublieEvent($utilisateur)
            );

            $this->getEm()->flush();

            return $this->render('FlairUserBundle:Security:motdepasseOublieSuccess.html.twig');
        }

        return $this->render('FlairUserBundle:Security:motdepasseOublie.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Permets à l'utilisateur de re-initialiser son mot de passe.
     */
    public function motdepasseResetAction($token, Request $request)
    {
        $utilisateur = $this->Repo('FlairUserBundle:AbstractUtilisateur')->findOneBy(
            array('resetToken' => $token)
        );

        // Si l'utiliasteur n'a pas été trouvé
        if (!$utilisateur) {
            throw $this->createNotFoundException();
        }

        // Validation que la demande remonte a moins de 24h.
        if ($utilisateur->getResetDate() < (new \DateTime())->sub(new \DateInterval('P1D'))) {
            throw $this->createNotFoundException();
        }

        $model = new Motdepasse();
        $form = $this->createForm(new MotdepasseType(), $model);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $password = $this->encryptPassword($utilisateur, $model->getMotdepasse(), $utilisateur->getSalt());
            $utilisateur->setPassword($password);
            $utilisateur->setResetToken(null);
            $utilisateur->setResetDate(null);

            $this->getDoctrine()->getManager()->flush();

            return $this->render('FlairUserBundle:Security:motdepasseResetSuccess.html.twig');
        }

        return $this->render('FlairUserBundle:Security:motdepasseReset.html.twig', array(
            'form'  => $form->createView(),
            'token' => $token
        ));
    }
}
