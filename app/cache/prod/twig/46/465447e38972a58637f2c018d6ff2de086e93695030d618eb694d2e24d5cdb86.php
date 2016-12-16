<?php

/* FlairCoreBundle:Homepage:faq.html.twig */
class __TwigTemplate_b945f63371cdc65f8b49c3da71322b83f334598323bfc51a4fa958e5003002a8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FlairCoreBundle:Homepage:faq.html.twig", 1);
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
        echo "<div class=\"inner\">

    <div class=\"hp-faq\">
        <h2>A qui s'adresse la plateforme ?</h2>

        <p>
            A toute personne souhaitant consulter des prestataires dans le cadre d'obligations légales de mise en
            concurrence. Exemples : collectivités locales, établissements public, SEM, syndic...
        </p>

        <h2>Quels sont les types de demandes de prestations qui peuvent être publiées ?</h2>

        <p>
            Tout type d'achats ne rentrant pas dans d'autres procédures.
        </p>

        <h2>Quels sont les prestataires référencés sur le site ?</h2>

        <p>
            Les prestataires référencés sont enregistrés par la communauté des utilisateurs de mise-en-concurrence.com.
        </p>

        <h2>Pourquoi utiliser mise-en-concurrence.com pour la gestion de mes consultations ?</h2>
        <ul>
            <li>
                Vos consultations entrent dans le cadre des obligations légales de respect des procédures de mise en
                concurrence des prestataires.
            </li>
            <li>Les prestataires référencés sur le site sont cooptés par les autres utilisateurs</li>
            <li>Vous pouvez trouver des prestataires dans des domaines d'activités spécifiques</li>
        </ul>

        <h2>Je ne trouve pas les éléments dont j'ai besoin pour travailler</h2>

        <p>
            La version en ligne est actuellement un prototype qui évoluera en fonction de vos besoins et vos remarques,
            alors n'hésitez pas à nous transmettre vos souhaits et vos observations.
        </p>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "FlairCoreBundle:Homepage:faq.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairCoreBundle:Homepage:faq.html.twig", "/var/www/src/Flair/CoreBundle/Resources/views/Homepage/faq.html.twig");
    }
}
