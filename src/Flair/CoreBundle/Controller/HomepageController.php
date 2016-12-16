<?php

namespace Flair\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Homepage publique.
 */
class HomepageController extends Controller
{
    /**
     * Affiche la homepage publique.
     */
    public function indexAction()
    {
        return $this->render('FlairCoreBundle:Homepage:index.html.twig', array());
    }

    public function inscriptionAction()
    {
        return $this->render('FlairCoreBundle:Homepage:inscription.html.twig');
    }

    /**
     * Affiche la page de FAQ.
     */
    public function faqAction()
    {
        return $this->render('FlairCoreBundle:Homepage:faq.html.twig');
    }

    /**
     * Affiche la page de FAQ.
     */
    public function mentionsLegalesAction()
    {
        return $this->render('FlairCoreBundle:Homepage:mentionsLegales.html.twig');
    }

    public function inscriptionPrestataireAction()
    {
        return $this->render("FlairCoreBundle:Homepage:inscriptionPresta.html.twig");
    }
}
