<?php

namespace Flair\UserBundle\Controller;


use Flair\CoreBundle\Controller\CoreController;
use Flair\CoreBundle\Security\VoterOrganisme;
use Flair\CoreBundle\Security\VoterPrestataire;
use Flair\UserBundle\Entity\AbstractUtilisateur;
use Flair\UserBundle\Entity\Organisme;
use Flair\UserBundle\Entity\Prestataire;
use Flair\UserBundle\Form\Type\ProfilPrestataireType;
use Flair\UserBundle\Model\ProfilOrganisme;
use Flair\UserBundle\Form\Type\ProfilOrganismeType;
use Flair\UserBundle\Model\ProfilPrestataire;
use Flair\CoreBundle\Entity\Tag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur pour la gestion des services.
 */
class ServicesController extends CoreController
{
    /**
     * Affiche la liste de mes services.
     */
    public function listerAction()
    {
        // TODO add filtre

        $repo = "FlairUserBundle:Organisme";

        if (!$this->isOrganisme()) {
            $repo = "FlairUserBundle:Prestataire";
        }

        $services = $this->getDoctrine()
            ->getRepository($repo)
            ->findService($this->getUser());

        return $this->render('FlairUserBundle:Services:lister.html.twig', array(
            'services'     => $services
        ));
    }

    /**
     * Affiche le service.
     */
    public function afficherAction(AbstractUtilisateur $user)
    {
        // TODO check access

        if ($this->isOrganisme($user)) {
            return $this->afficherOrganisme($user);
        } else {
            return $this->afficherPrestataire($user);
        }
    }

    private function afficherOrganisme(Organisme $organisme)
    {
        $this->isGranted(VoterOrganisme::VIEW, $organisme);

        $doctrine = $this->getDoctrine();

        $nbConsultations = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->countConsultations($organisme->getId());
        $nbPrestataires = $doctrine->getRepository('FlairUserBundle:Organisme')
            ->countPrestataires($organisme->getId());
        $budgetMoyen = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->getAVGBudget($organisme->getId());
        $reponsesMoyenne = $doctrine->getRepository('FlairCoreBundle:Reponse')
            ->getAVGNumberReponses($organisme->getId());
        $prestatairesMoyen = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->countAVGPrestataires($organisme->getId());
        $statsConsultation = $doctrine->getRepository('FlairCoreBundle:Consultation')
            ->getStatsConsultation($organisme->getId());

        return $this->render(
            'FlairUserBundle:Services:afficherOrganisme.html.twig', array(
                'organisme'         => $organisme,
                'nbConsult'         => $nbConsultations,
                'nbPresta'          => $nbPrestataires,
                'budget'            => (is_null($budgetMoyen)) ? 0 : round($budgetMoyen, 2),
                'reponses'          => (is_null($reponsesMoyenne)) ? 0 : round($reponsesMoyenne, 2),
                'prestaMoyen'       => (is_null($prestatairesMoyen)) ? 0 : round($prestatairesMoyen, 2),
                'statsConsultation' => $statsConsultation,
                'completion'        => $organisme->getCompletion()
            )
        );
    }

    private function afficherPrestataire(Prestataire $prestataire)
    {
        $this->isGranted(VoterPrestataire::VIEW, $prestataire);

        return $this->render('FlairUserBundle:Services:afficherPrestataire.html.twig',
            array(
                'prestataire' => $prestataire
            ));
    }

    /**
     * Modifier un service
     */
    public function modifierAction(AbstractUtilisateur $user, Request $request)
    {
        // TODO check access
        // TODO empêcher modification SIREN

        if ($this->isOrganisme($user)) {
            return $this->modifierOrganisme($user, $request);
        } else {
            return $this->modifierPrestataire($user, $request);
        }
    }

    private function modifierOrganisme(Organisme $organisme, Request $request)
    {
        $this->isGranted(VoterOrganisme::EDIT, $organisme);

        $model = new ProfilOrganisme();
        $model->initialize($organisme);

        $form = $this->createForm(ProfilOrganismeType::class, $model);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $model->merge($organisme);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('flair_user_service_list'));
        }

        return $this->render('FlairUserBundle:Services:modifierOrganisme.html.twig', array(
            'form' => $form->createView(),
            'organisme' => $organisme
        ));
    }

    private function modifierPrestataire(Prestataire $prestataire, Request $request)
    {
        $this->isGranted(VoterPrestataire::EDIT, $prestataire);

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

        return $this->render('FlairUserBundle:Services:modifierPrestataire.html.twig', array(
            'form'        => $form->createView(),
            'prestataire' => $this->getUser()
        ));
    }

    public function supprimerServiceAction(Organisme $organisme)
    {
        $this->isGranted(VoterOrganisme::DELETE, $organisme);

        $this->getEm()->remove($organisme);
        $this->getEm()->flush();

        return $this->redirect($this->generateUrl("flair_user_services_list"));
    }
}
