<?php

namespace Flair\UserBundle\Controller;

use Flair\CoreBundle\Entity\Tag;
use Flair\CoreBundle\Controller\CoreController;

use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Administrateur;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;
use Flair\UserBundle\Model\Motdepasse;

use Flair\UserBundle\Form\Type\ProfilOrganismeType;
use Flair\UserBundle\Form\Type\ProfilPrestataireType;
use Flair\UserBundle\Model\ProfilOrganisme;
use Flair\UserBundle\Model\ProfilPrestataire;

use Flair\OrganismeBundle\Form\Type\MotdepasseType;
use Symfony\Component\HttpFoundation\Request;

/**
 * La gestion du profil est commune aux deux types d'utilisateurs.
 */
class ProfilController extends CoreController
{
    /**
     * Affichage du profil utilisateur.
     */
    public function afficherAction()
    {
        $user = $this->getUser();

        if ($user instanceof Organisme) {
            return $this->afficherOrganisme($user);
        } elseif ($user instanceof Prestataire) {
            return $this->afficherPrestataire($user);
        } elseif ($user instanceof Administrateur) {
            return $this->redirect($this->generateUrl("sonata_admin_dashboard"));
        } else {
            throw new \Exception("This user is not managed");
        }
    }

    private function afficherOrganisme(AbstractUtilisateur $user)
    {
        $doctrine = $this->getDoctrine();

        $nbConsultations = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->countConsultations($user->getId());
        $nbPrestataires = $doctrine->getRepository('FlairUserBundle:Organisme')
            ->countPrestataires($user->getId());
        $budgetMoyen = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->getAVGBudget($user->getId());
        $reponsesMoyenne = $doctrine->getRepository('FlairCoreBundle:Reponse')
            ->getAVGNumberReponses($user->getId());
        $prestatairesMoyen = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->countAVGPrestataires($user->getId());
        $statsConsultation = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->getStatsConsultation($user->getId());

        return $this->render(
            'FlairOrganismeBundle:Profil:afficher.html.twig', array(
                'utilisateur'       => $user,
                'nbConsult'         => $nbConsultations,
                'nbPresta'          => $nbPrestataires,
                'budget'            => (is_null($budgetMoyen)) ? 0 : round($budgetMoyen, 2),
                'reponses'          => (is_null($reponsesMoyenne)) ? 0 : round($reponsesMoyenne, 2),
                'prestaMoyen'       => (is_null($prestatairesMoyen)) ? 0 : round($prestatairesMoyen, 2),
                'statsConsultation' => $statsConsultation,
                'completion'        => $user->getCompletion()
            )
        );
    }

    private function afficherPrestataire(AbstractUtilisateur $user)
    {
        // On change en eager loading pour afficher le profil
        return $this->render('FlairPrestataireBundle:Profil:afficher.html.twig',
            array(
                'utilisateur' => $user,
                'completion' => $user->getCompletion()
        ));
    }

    /**
     * Permets la modification du profil.
     */
    public function modifierAction(Request $request)
    {
        $user = $this->getUser();

        if ($user instanceof Organisme) {
            return $this->modifierOrganisme($user, $request);
        } elseif ($user instanceof Prestataire) {
            return $this->modifierPrestataire($user, $request);
        } elseif ($user instanceof Administrateur) {
            return $this->redirect($this->generateUrl("sonata_admin_dashboard"));
        } else {
            throw new \Exception("This user is not managed");
        }
    }

    /**
     * Ecran de modification pour un organisme.
     */
    private function modifierOrganisme(Organisme $organisme, Request $request)
    {
        $model = new ProfilOrganisme();
        $model->initialize($organisme);

        $form = $this->createForm(ProfilOrganismeType::class, $model);
/*
        if (!$this->get("security.context")->isGranted("ROLE_GESTIONNAIRE")) {
            $form->add("siren", "text", array("read_only" => true, "label" => "SIREN"));
        }
*/
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $model->merge($organisme);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('flair_user_profil_see'));
        }

        return $this->render('FlairOrganismeBundle:Profil:modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Modification de profil pour un prestataire.
     */
    private function modifierPrestataire(Prestataire $prestataire, Request $request)
    {
        $model = new ProfilPrestataire();
        $model->initialize($prestataire);

        $form = $this->createForm(ProfilPrestataireType::class, $model);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $tags = $request->get('tagList');

            if (!is_null($tags) && sizeof($tags) !== 0 && $tags !== "") {
                $tags = explode(',', $tags);
                foreach ($tags as $tag) {
                    $t = $this->getDoctrine()->getRepository('FlairCoreBundle:Tag')->findOneByName($tag);

                    if (!$prestataire->getTags()->contains($t)) {
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
            } else {
                foreach ($prestataire->getTags() as $tag) {
                    $prestataire->getTags()->removeElement($tag);
                }
            }

            $model->merge($prestataire);
            $this->getDoctrine()->getManager()->persist($prestataire);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('flair_user_profil_see'));
        }

        return $this->render('FlairPrestataireBundle:Profil:modifier.html.twig', array(
            'form'        => $form->createView(),
            'utilisateur' => $this->getUser()
        ));
    }

    /**
     * Permets le changement de mot de passe pour l'utilisateur.
     */
    public function motdepasseAction(Request $request)
    {
        $motdepasse = new Motdepasse();
        $utilisateur = $this->getUser();

        $form = $this->createForm(MotdepasseType::class, $motdepasse);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $salt = md5(uniqid(null, true));
            $utilisateur->setSalt($salt);

            $password = $this->encryptPassword($utilisateur, $motdepasse->getMotdepasse(), $salt);
            $utilisateur->setPassword($password);

            // On sauvageder le user
            $this->getEm()->flush();

            return $this->redirect($this->generateUrl('flair_user_profil_see'));
        }

        return $this->render('FlairUserBundle:Profil:motdepasse.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
