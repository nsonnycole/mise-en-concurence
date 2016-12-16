<?php

/* FlairUserBundle:Inscription:sirenAlreadyExist.html.twig */
class __TwigTemplate_af1665a1e4baba3e2a0860eb521276b8fa0ff9ef6777ffd9c47d5923df127f7a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FlairUserBundle:Inscription:sirenAlreadyExist.html.twig", 1);
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
        echo "    <div class=\"inner\">
        <div class=\"prefix_1\">
            <p>
                Ce numéro de SIREN est déjà utilisé, merci de contacter ";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gestionnaire"]) ? $context["gestionnaire"] : null), "nom", array()), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gestionnaire"]) ? $context["gestionnaire"] : null), "email", array()), "html", null, true);
        echo " pour vous inscrire.
            </p>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Inscription:sirenAlreadyExist.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 7,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Inscription:sirenAlreadyExist.html.twig", "/var/www/src/Flair/UserBundle/Resources/views/Inscription/sirenAlreadyExist.html.twig");
    }
}
