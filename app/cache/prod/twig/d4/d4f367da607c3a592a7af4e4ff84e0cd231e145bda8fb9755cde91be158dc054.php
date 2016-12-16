<?php

/* FlairUserBundle:Mails:confirmationEmail.html.twig */
class __TwigTemplate_41c7f4df3e7b3e489b49daaae947aa6fcaf52337c04ad71b625704dbc470c43a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<p>Bonjour,</p>

<p>
    Votre demande d’inscription a bien été prise en compte. Pour confirmer la validité de votre email veuillez cliquer
    <a href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("flair_user_confirmation_email", array("token" => (isset($context["tokenUrl"]) ? $context["tokenUrl"] : null))), "html", null, true);
        echo "\">ici</a>
</p>

<p>
    Cordialement, <br/>
    L'équipe Mise-en-concurrence
</p>
";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Mails:confirmationEmail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Mails:confirmationEmail.html.twig", "/var/www/src/Flair/UserBundle/Resources/views/Mails/confirmationEmail.html.twig");
    }
}
