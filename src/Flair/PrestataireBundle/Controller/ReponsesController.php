<?php

namespace Flair\PrestataireBundle\Controller;

use Flair\CoreBundle\Entity\Consultation;
use Flair\CoreBundle\Entity\Document;
use Flair\CoreBundle\Entity\Reponse;
use Flair\CoreBundle\Events\Consultation\ConsultationFinishedEvent;
use Flair\CoreBundle\Events\Consultation\ConsultationStartedEvent;
use Flair\CoreBundle\Events\Consultation\NewReponseConsultationEvent;
use Flair\CoreBundle\Events\ConsultationEvents;
use Flair\CoreBundle\Form\Type\DocumentType;
use Flair\PrestataireBundle\Form\Type\DocumentReponseType;
use Flair\PrestataireBundle\Form\Type\FiltrePropositionType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeOneType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeThreeType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeTwoDocumentsType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeTwoType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeTwoSaisieType;
use Flair\PrestataireBundle\Form\Type\ReponseEtapeZeroType;
use Flair\PrestataireBundle\Model\DevisModel;
use Flair\PrestataireBundle\Model\FiltrePropositionModel;
use Flair\PrestataireBundle\Model\ReponseEtapeOne;
use Flair\PrestataireBundle\Model\ReponseEtapeTwo;
use Flair\PrestataireBundle\Model\ReponseEtapeZero;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controlleur la navigation des prestataires.
 */
class ReponsesController extends Controller
{
    /**
     * Affiche la liste des consultations.
     */
    public function listerAction(Request $request)
    {
        $filtre = new FiltrePropositionModel();
        $filtre->setPrestataire($this->getUser());
        $filtreForm = $this->createForm(new FiltrePropositionType(), $filtre);
        $filtreForm->handleRequest($request);

        $reponses = $this->getDoctrine()
            ->getRepository('FlairCoreBundle:Reponse')
            ->findByFiltreAndPrestataire($filtre, $this->getUser());

        return $this->render('FlairPrestataireBundle:Reponses:lister.html.twig', array(
            'reponses' => $reponses,
            'filtre'   => $filtreForm->createView()
        ));
    }

    /**
     * Affiche la demande.
     */
    public function afficherAction(Reponse $reponse)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        if ($reponse->getStatut() == Reponse::WAITING &&
            $reponse->getConsultation()->getDateLimite() > new \DateTime()) {
            return $this->redirect(
                $this->generateUrl('Prestataire_propositions_etape_one', array('id' => $reponse->getId()))
            );
        }

        return $this->render('FlairPrestataireBundle:Reponses:afficher.html.twig', array('reponse' => $reponse));
    }

    /**
     * Affiche l'etape 1 du formulaire de reponse.
     */
    public function etapeOneAction(Reponse $reponse, Request $request)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $model = new ReponseEtapeOne();
        $model->initialize($reponse);
        $form = $this->createForm(new ReponseEtapeOneType(), $model);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $model->merge($reponse);
            $this->getDoctrine()->getManager()->flush();

            // Brouillon on non?
            if ($request->request->has('brouillon')) {
                $reponse->setStatut(REPONSE::DRAFT);
                $this->getDoctrine()->getManager()->persist($reponse);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirect($this->generateUrl('Prestataire_propositions'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Prestataire_propositions_etape_two_saisie',
                        array('id' => $reponse->getId())
                    )
                );
            }
        }

        return $this->render('FlairPrestataireBundle:Reponses:etape1.html.twig', array(
            'form'    => $form->createView(),
            'reponse' => $reponse
        ));
    }

    /**
     * Affiche l'etape 2 de la reponse.
     *
     * @Template("FlairPrestataireBundle:Reponses:etape2_saisie.html.twig")
     *
     */
    public function etapeTwoSaisieAction(Reponse $reponse, Request $request)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $form = $this->createForm(new ReponseEtapeTwoSaisieType(), $reponse);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if ($request->request->has('brouillon')) {
                $reponse->setStatut(REPONSE::DRAFT);
                $this->getDoctrine()->getManager()->persist($reponse);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirect($this->generateUrl('Prestataire_propositions'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Prestataire_propositions_etape_three',
                        array('id' => $reponse->getId())
                    )
                );
            }
        }

        return array(
            'reponse' => $reponse,
            'form'    => $form->createView()
        );
    }

    /**
     * Affiche la saisie de l'etape 2 en uploadant un devis.
     *
     * @Template("FlairPrestataireBundle:Reponses:etape2_documents.html.twig")
     */
    public function etapeTwoDocumentsAction(Reponse $reponse, Request $request)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $manager = $this->getDoctrine()->getManager();
        $model = new ReponseEtapeTwo($reponse);
        $form = $this->createForm(new ReponseEtapeTwoDocumentsType(), $model);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $model->merge($reponse);
            $manager->persist($reponse);
            $manager->flush();

            if ($request->request->has('brouillon')) {
                $reponse->setStatut(REPONSE::DRAFT);
                $manager->persist($reponse);
                $manager->flush();
                
                return $this->redirect($this->generateUrl('Prestataire_propositions'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Prestataire_propositions_etape_three',
                        array('id' => $reponse->getId())
                    )
                );
            }
        }

        return array(
            'reponse' => $reponse,
            'form'    => $form->createView()
        );
    }

    /**
     * Affiche la page 3 pour l'affichage des documents.
     *
     * @Template("FlairPrestataireBundle:Reponses:etape3.html.twig")
     */
    public function etapeThreeAction(Reponse $reponse, Request $request)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $document = new Document();
        $form = $this->createForm(new DocumentReponseType(), $document);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $reponse->getDocuments()->add($document);

            // Remise a zero du formulaire.
            $document = new Document();
            $form = $this->createForm(new DocumentReponseType(), $document);

            $this->getDoctrine()->getManager()->flush();

            if ($request->request->has('brouillon')) {
                return $this->redirect($this->generateUrl('Prestataire_propositions'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Prestataire_propositions_etape_three',
                        array('id' => $reponse->getId())
                    )
                );
            }
        }

        return array(
            'reponse' => $reponse,
            'form'    => $form->createView()
        );
    }

    /**
     * Affiche la page 4 pour le résumé et envoie de la réponse.
     *
     * @Template("FlairPrestataireBundle:Reponses:etape4.html.twig")
     */
    public function etapeFourAction(Reponse $reponse, Request $request)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        return array('reponse' => $reponse);
    }

    /**
     * Suppression d'un document d'une reponse.
     */
    public function etapeThreeSupprimerAction($idReponse, $idDocument)
    {
        $reponse = $this->getDoctrine()->getRepository('FlairCoreBundle:Reponse')->find($idReponse);
        $document = $this->getDoctrine()->getRepository('FlairCoreBundle:Document')->find($idDocument);

        $reponse->getDocuments()->removeElement($document);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl('Prestataire_propositions_etape_three', array('id' => $reponse->getId()))
        );
    }

    /**
     * Le prestataire envoie sa reponse.
     */
    public function envoyerAction(Reponse $reponse)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $reponse->setStatut(Reponse::ANSWERED);
        $reponse->setDateReponse(new \DateTime());
        $this->getDoctrine()->getManager()->flush();

        $this->get('event_dispatcher')->dispatch(
            ConsultationEvents::NEW_REPONSE,
            new NewReponseConsultationEvent($reponse)
        );


        $this->get('session')->getFlashBag()->add('success', 'Votre proposition a bien été envoyée');

        return $this->redirect($this->generateUrl('Prestataire_propositions'));
    }

    /**
     * La prestation a été démarrée.
     */
    public function debuterAction(Reponse $reponse)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $reponse->getConsultation()->setStatut(Consultation::STARTED);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl('Prestataire_propositions_afficher', array('id' => $reponse->getId()))
        );
    }

    /**
     * La prestation a été terminée.
     */
    public function terminerAction(Reponse $reponse)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $reponse->getConsultation()->setStatut(Consultation::FINISHED);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl('Prestataire_propositions_afficher', array('id' => $reponse->getId()))
        );
    }

    public function annulerAction(Reponse $reponse)
    {
        if ($reponse->getPrestataire() != $this->getUser()) {
            return $this->redirect($this->generateUrl('Prestataire_propositions'));
        }

        $reponse->setStatut(Reponse::DECLINE);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('Prestataire_propositions'));
    }
}
