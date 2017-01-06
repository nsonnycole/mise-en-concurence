<?php

namespace Flair\UserBundle\Controller;

use Flair\UserBundle\Form\Type\InscriptionOrganismeType;
use Flair\UserBundle\Form\Type\InscriptionServiceOrganismeType;
use Flair\UserBundle\Form\Type\ProfilOrganismeType;
use Flair\UserBundle\Form\Type\ProfilPrestataireType;
use Flair\OrganismeBundle\Form\Type\ConsultationEtape1Type;
use Flair\OrganismeBundle\Form\Type\ConsultationType;
use Flair\UserBundle\Form\Type\InscriptionPrestataireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controlleur pour la gestion des catégories dans les formulaires.
 */
class CategoriesController extends Controller
{
    /**
     * Inscription pour les organismes.
     */
    public function inscriptionOrganismeAction(Request $request)
    {
        $class = (!$request->request->has("inscription_service_organisme_form")) ? InscriptionOrganismeType::class : InscriptionServiceOrganismeType::class;
        return $this->process(
            $class,
            'FlairUserBundle:Categories:organisme.html.twig',
            'Categories_inscription_organisme',
            $request,
            'Organisme'
        );
    }

    /**
     * Pour l'inscription d'un prestataire.
     */
    public function inscriptionPrestataireAction(Request $request)
    {
        return $this->process(
            InscriptionPrestataireType::class,
            'FlairUserBundle:Categories:prestataire.html.twig',
            'Categories_inscription_prestataire',
            $request,
            'Prestataire'
        );
    }

    /**
     * Pour la creation d'une demande
     */
    public function creationConsultationAction(Request $request)
    {
        return $this->process(
            ConsultationEtape1Type::class,
            'FlairUserBundle:Categories:prestataire.html.twig',
            'Categories_creation_consultation',
            $request,
            'Prestataire'
        );
    }

    /**
     * Pour la modification d'une consultation.
     */
    public function modificationProfilOrganismeAction(Request $request)
    {
        return $this->process(
            ProfilOrganismeType::class,
            'FlairUserBundle:Categories:prestataire.html.twig',
            'Categories_profil_organisme',
            $request,
            'Organisme'
        );
    }

    /**
     * Pour la modification d'une consultation.
     */
    public function modificationProfilPrestataireAction(Request $request)
    {
        return $this->process(
            ProfilPrestataireType::class,
            'FlairUserBundle:Categories:prestataire.html.twig',
            'Categories_profil_prestataire',
            $request,
            'Prestataire'
        );
    }

    /**
     * Pour la modification d'une consultation.
     */
    public function modificationConsultationAction(Request $request)
    {
        return $this->process(
            ConsultationType::class,
            'FlairUserBundle:Categories:prestataire.html.twig',
            'Categories_modification_consultation',
            $request,
            'Prestataire'
        );
    }

    /**
     * Recrée un formulaire à partir.
     *
     */
    protected function process($type, $template, $url, Request $request, $category)
    {
        $form = $this->createForm($type);
        $form->handleRequest($request);
        $formRequest = $request->request->get($form->getName());

        if (is_null($formRequest)) {
            $formRequest = $request->request->get("inscription_service_organisme_form"); // dirty code
        }

        $categorieLevelOne = $this->getDoctrine()
        ->getRepository('FlairUserBundle:Categorie' . $category)
        ->findOneById($formRequest['categorieLevelOne']);

        $categories1 = array();
        $list1 = $this->getDoctrine()
            ->getRepository('FlairUserBundle:Categorie' . $category)
            ->findCategoriesFilles($formRequest['categorieLevelOne'])
            ->getQuery()
            ->getResult();
        array_push($categories1, $categorieLevelOne);

        if (sizeof($list1) > 0) {
            foreach ($list1 as $cat) {
                array_push($categories1, $cat->getId());
            }    
        }

        $nbCategoriesOne = $this->getDoctrine()
            ->getRepository('FlairUserBundle:' . $category)
            ->countByCategories($categories1);
        $nbCategoriesTwo = (isset($formRequest['categorieLevelTwo'])) ? $this->getDoctrine()
            ->getRepository('FlairUserBundle:' . $category)
            ->countByCategories(array($formRequest['categorieLevelTwo'])) : 0;
        $nbCategoriesThree = (isset($formRequest['categorieLevelThree'])) ? $this->getDoctrine()
            ->getRepository('FlairUserBundle:' . $category)
            ->countByCategories(array($formRequest['categorieLevelThree'])) : 0;

        $result = array(
            'form'              => $form->createView(),
            'url'               => $this->generateUrl($url),
            'hideErrors'        => true,
            'nbCategoriesOne'   => $nbCategoriesOne,
            'nbCategoriesTwo'   => $nbCategoriesTwo,
            'nbCategoriesThree' => $nbCategoriesThree,
            'category'          => $category,
            'levelOne'          => (!is_null($categorieLevelOne)) ? $categorieLevelOne->getNom() : null
        );

        if ($request->get('_route') === "Categories_inscription_prestataire") {
            $result['inscription'] = true;
        }

        return $this->render($template, $result);
    }
}
