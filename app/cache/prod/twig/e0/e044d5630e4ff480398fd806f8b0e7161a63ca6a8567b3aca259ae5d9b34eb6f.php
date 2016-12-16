<?php

/* FlairCoreBundle:Homepage:index.html.twig */
class __TwigTemplate_72e0e77dea7cc1bac827d41013cbdfb971490a385026edb293c3a9015a28a27c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FlairCoreBundle:Homepage:index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"inner hp-presentation\">
    <div class=\"simplify-procedures\">
        <h1>Des mises en concurrence plus efficaces dans le respect de vos obligations légales</h1>
    </div>

    <div class=\"discover-dedicated-tools\">
        <h3>
            Mise-en-concurrence.com est une application de gestion et de suivi en ligne de vos consultations associée à une
            plateforme de mise en relation entre des acheteurs publics et des prestataires. En quelques clics, vous
            formalisez et suivez toutes vos demandes de prestations.
        </h3>
    </div>

    ";
        // line 17
        if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 18
            echo "        <div class=\"free-registration\">
            <a href=\"";
            // line 19
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("Inscription");
            echo "\" class=\"big btn bold orange\">Inscription gratuite</a>
        </div>
    ";
        }
        // line 22
        echo "
    <div class=\"hp-process clearfix\">
        <ul class=\"hp-list \">
            <li class=\"hp-first\">
                Je formule mon besoin de prestation
            </li>
            <li class=\"separator\"></li>
            <li class=\"hp-second\">
                Je le publie auprès de mes prestataires habituels <br/>
                et/ou réferencés sur la plateforme
            </li>
            <li class=\"separator\"></li>
            <li class=\"hp-third\">
                Je suis les réponses des prestataires interrogés
            </li>
            <li class=\"separator\"></li>
            <li class=\"hp-fourth\">
                Je sélectionne la meilleure proposition
            </li>
        </ul>
    </div>
</div>

<div class=\"hp-infos\">
    <div class=\"inner\">
        <h2>Vous êtes acheteur</h2>
        <p class=\"description\">
            Formalisez votre mise en concurrence pour tous vos besoins de prestations dans un cadre configuré.<br/>
            Centralisez toutes vos demandes de prestations sur un outil unique.<br/>
            Interrogez et élargissez votre vivier de prestataires référencés sur la plateforme dédiée. <br/>
            Optimisez le traitement de vos demandes grâce à un outil de suivi des réponses des prestataires. <br/>
            Archivez toutes vos consultations pour les dupliquer ou justifier vos procédures d'achat.
        </p>
    </div>
</div>

<div class=\"hp-bottom\">
    <a href=\"";
        // line 59
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("FAQ");
        echo "\" class=\"btn bold\">En savoir +</a>
</div>

";
    }

    public function getTemplateName()
    {
        return "FlairCoreBundle:Homepage:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 59,  57 => 22,  51 => 19,  48 => 18,  46 => 17,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairCoreBundle:Homepage:index.html.twig", "/var/www/src/Flair/CoreBundle/Resources/views/Homepage/index.html.twig");
    }
}
