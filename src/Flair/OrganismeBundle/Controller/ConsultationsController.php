<?php

namespace Flair\OrganismeBundle\Controller;

use Flair\CoreBundle\Controller\CoreController;
use Flair\CoreBundle\Entity\Consultation;
use Flair\CoreBundle\Entity\Document;
use Flair\CoreBundle\Entity\Reponse;
use Flair\CoreBundle\Events\Consultation\AnnulationConsultationEvent;
use Flair\CoreBundle\Events\Consultation\DiffusionConsultationEvent;
use Flair\CoreBundle\Events\ConsultationEvents;

use Flair\CoreBundle\Security\VoterConsultation;
use Flair\OrganismeBundle\Form\Type\ConsultationEtape1Type;
use Flair\OrganismeBundle\Form\Type\ConsultationEtape2Type;
use Flair\OrganismeBundle\Form\Type\ConsultationEtape3Type;
use Flair\OrganismeBundle\Form\Type\ConsultationType;
use Flair\OrganismeBundle\Form\Type\DocumentConsultationType;
use Flair\OrganismeBundle\Form\Type\FiltreConsultationType;
use Flair\OrganismeBundle\Form\Type\FiltrePrestataireDiffusionType;
use Flair\OrganismeBundle\Form\Type\PublicationFormType;
use Flair\OrganismeBundle\Model\ConsultationEtape1Model;
use Flair\OrganismeBundle\Model\ConsultationEtape2Model;
use Flair\OrganismeBundle\Model\ConsultationModel;
use Flair\OrganismeBundle\Model\FiltreConsultationModel;
use Flair\OrganismeBundle\Model\FiltrePrestataireDiffusionModel;
use Flair\OrganismeBundle\Model\PublicationModel;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Affichage des consultations.
 *
 * La création d'une consultation passe par le wizard qui guide étape par étape la création d'une mise en
 * concurrence. La modification par contre se fait tout d'un coup.
 */
class ConsultationsController extends CoreController
{
    /**
     * Affiche la page des demandes de consultation de l'organisme.
     */
    public function listerAction(Request $request)
    {
        $organisme = $this->getUser();
        $filtre = new FiltreConsultationModel();
        $filtreForm = $this->createForm(FiltreConsultationType::class, $filtre);
        $filtreForm->handleRequest($request);

        $consultations = $this->getDoctrine()
            ->getRepository('FlairCoreBundle:Consultation')
            ->findByFiltreAndOrganisme($filtre, $organisme);

        $nbPrestataires = $this->getDoctrine()
            ->getRepository('FlairUserBundle:Prestataire')
            ->countByOrganisme($organisme);

        return $this->render('FlairOrganismeBundle:Consultations:lister.html.twig', array(
            'consultations'  => $consultations,
            'nbPrestataires' => $nbPrestataires,
            'filtreForm'     => $filtreForm->createView()
        ));
    }

    /**
     * Modifier l'étape 1 de la consultation.
     */
    public function modifierEtape1Action(Consultation $consultation, Request $request)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $consultationModel = new ConsultationEtape1Model();
        $consultationModel->initialize($consultation);
        $form = $this->createForm(ConsultationEtape1Type::class, $consultationModel);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $consultationModel->merge($consultation);
            $this->getDoctrine()->getManager()->flush();

            // Brouillon on non?
            if ($request->request->has('brouillon')) {
                return $this->redirect($this->generateUrl('Organisme_consultations'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Organisme_creation_consultation_etape2',
                        array('id' => $consultation->getId())
                    )
                );
            }
        }

        return $this->render('FlairOrganismeBundle:Consultations:creation/etape1.html.twig', array(
            'form'         => $form->createView(),
            'consultation' => $consultation
        ));
    }

    /**
     * Affiche la page de création de consultation.
     */
    public function creationEtape1Action(Request $request)
    {
        $consultationModel = new ConsultationEtape1Model();
        $form = $this->createForm(ConsultationEtape1Type::class, $consultationModel);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $consultation = $consultationModel->toConsultation();
            $consultation->setOrganisme($this->getUser());
            $consultation->setStatut(Consultation::DRAFT);

            $this->getDoctrine()->getManager()->persist($consultation);
            $this->getDoctrine()->getManager()->flush();

            // Brouillon on non?
            if ($request->request->has('brouillon')) {
                return $this->redirect($this->generateUrl('Organisme_consultations'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Organisme_creation_consultation_etape2',
                        array('id' => $consultation->getId())
                    )
                );
            }
        }

        return $this->render('FlairOrganismeBundle:Consultations:creation/etape1.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Affiche le formulaire de l'étape 2.
     */
    public function creationEtape2Action(Consultation $consultation, Request $request)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $model = new ConsultationEtape2Model();
        $model->initialize($consultation);

        $form = $this->createForm(ConsultationEtape2Type::class, $model);
        $form->handleRequest($request);

            // Si le formulaire est valide, alors on sauvegarde les modifications.
        if ($form->isValid()) {
            $model->merge($consultation);
            $this->getDoctrine()->getManager()->flush();

            // Brouillon on non?
            if ($request->request->has('brouillon')) {
                return $this->redirect($this->generateUrl('Organisme_consultations'));
            } else {
                return $this->redirect(
                    $this->generateUrl(
                        'Organisme_creation_consultation_etape3',
                        array('id' => $consultation->getId())
                    )
                );
            }
        }

        return $this->render('FlairOrganismeBundle:Consultations:creation/etape2.html.twig', array(
            'form'         => $form->createView(),
            'consultation' => $consultation
        ));
    }

    /**
     * Affiche la 3e etape du formulaire.
     */
    public function creationEtape3Action(Consultation $consultation, Request $request)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $document = new Document();
        $form = $this->createForm(DocumentConsultationType::class, $document);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $consultation->getDocuments()->add($document);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect(
                $this->generateUrl(
                    'Organisme_creation_consultation_etape3',
                    array('id' => $consultation->getId())
                )
            );
        }

        // Gestion des documents annexss à la demande
        return $this->render('FlairOrganismeBundle:Consultations:creation/etape3.html.twig', array(
            'consultation' => $consultation,
            'form'         => $form->createView()
        ));
    }

    /**
     * Permets la publication d'une consultation.
     *
     * La consultation reste en brouillon tant qu'une invitation n'est pas envoyée.
     */
    public function publierAction(Consultation $consultation)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $filtre = new FiltrePrestataireDiffusionModel();
        $filtre->setCategorie($consultation->getCategorie());
        $filtreForm = $this->createForm(FiltrePrestataireDiffusionType($consultation), $filtre);

        $publicationModel = new PublicationModel();
        $publicationModel->setConsultation($consultation);
        $publicationModel->setFiltre($filtre);

        $form = $this->createForm(
            new PublicationFormType(),
            $publicationModel
        );

        return $this->render('FlairOrganismeBundle:Consultations:publier.html.twig', array(
            'consultation' => $consultation,
            'form'         => $form->createView(),
            'filtreForm'   => $filtreForm->createView()
        ));
    }

    /**
     * Filtre les prestataires.
     */
    public function publierFiltrerAction(Consultation $consultation, Request $request)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $filtre = new FiltrePrestataireDiffusionModel();
        $filtreForm = $this->createForm(new FiltrePrestataireDiffusionType($consultation), $filtre);

        $publicationModel = new PublicationModel();
        $publicationModel->setFiltre($filtre);
        $publicationModel->setConsultation($consultation);

        $categories = array();

        if (!is_null($request->get('categories'))) {
            foreach ($request->get('categories') as $categorie) {
                $categories[] = $this->getDoctrine()
                    ->getRepository('FlairUserBundle:CategoriePrestataire')
                    ->findOneByid($categorie);
            }
        }

        $form = $this->createForm(new PublicationFormType(array(
            'categories' => $categories,
            'tags'       => $request->get('tags'),
            'exclusive'  => $request->get('exclusive'),
            'ape'                          => $request->get('ape'),
            'perimetreIntervention'        => $request->get('perimetreIntervention'),
            'statut'     => $request->get('statut')    
        )),
        $publicationModel);

        return new Response($this->renderView('FlairOrganismeBundle:Consultations:publier_form.html.twig', array(
            'consultation' => $consultation,
            'form'         => $form->createView(),
            'filtreForm'   => $filtreForm->createView()
        )));
    }

    /**
     * Confirme l'envoi du formulaire.
     */
    public function postPublierAction(Consultation $consultation, Request $request)
    {
        //$this->isGranted(VoterConsultation::EDIT, $consultation);

        $publicationModel = new PublicationModel();
        $publicationModel->setConsultation($consultation);
        $publicationModel->setFiltre(null);

        $form = $this->createForm(PublicationFormType::class, $publicationModel);
        $form->handleRequest($request);
        $infoForm = $request->get($form->getName());

        foreach ($infoForm['prestataires'] as $prestataire) {
            $prestataire = $this->getDoctrine()->getManager()
            ->getRepository('FlairUserBundle:Prestataire')
            ->findOneById($prestataire);

            $reponse = new Reponse();
            $reponse->setPrestataire($prestataire);
            $reponse->setConsultation($consultation);

            $consultation->setDateUpdate(new \DateTime());
            $consultation->getReponses()->add($reponse);
            $this->getDoctrine()->getManager()->persist($reponse);
            $this->getDoctrine()->getManager()->flush();

            $this->get('event_dispatcher')->dispatch(
                ConsultationEvents::DIFFUSION,
                new DiffusionConsultationEvent($consultation, $prestataire, $reponse)
            );
        }

        $this->get('session')->getFlashBag()->add('success', 'Votre consultation a été diffusée avec succès');

        return $this->redirect($this->generateUrl(
            'Organisme_consultation_reponses',
            array('id' => $consultation->getId())
        ));
    }

    /**
     * Annulation d'une consultation. Suppression avec email aux prestataires. 
     */
    public function annulerAction(Consultation $consultation)
    {
        // Envoi d'email pour les prestataires invités.
        $this->get('event_dispatcher')->dispatch(
            ConsultationEvents::ANNULLATION,
            new AnnulationConsultationEvent($consultation)
        );
        
        $this->getDoctrine()->getManager()->remove($consultation);
        $this->getDoctrine()->getManager()->flush();
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect($this->generateUrl('Organisme_consultations'));
    }

    /**
     * Suppression d'un document d'une consultation.
     */
    public function supprimerDocumentAction($idConsultation, $idDocument)
    {
        $document = $this->getDoctrine()->getRepository('FlairCoreBundle:Document')->find($idDocument);
        $consultation = $this->getDoctrine()->getRepository('FlairCoreBundle:Consultation')->find($idConsultation);
        $consultation->getDocuments()->removeElement($document);

        $this->getDoctrine()->getManager()->remove($document);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl(
                'Organisme_creation_consultation_etape3',
                array('id' => $idConsultation)
            )
        );
    }

    public function selectionnerAction(Consultation $consultation)
    {
        $reponses = $this->getDoctrine()->getRepository('FlairCoreBundle:Reponse')
            ->getReponseRanking($consultation);

        return $this->render('FlairOrganismeBundle:Consultations:selectionner.html.twig', array(
            'consultation' => $consultation,
            'reponses'     => $reponses
        ));
    }
}
