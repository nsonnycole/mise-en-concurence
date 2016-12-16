<?php

/* FlairUserBundle:Mails:confirmationEmail.txt.twig */
class __TwigTemplate_08fcfff92bd6aaec7f3003afe21dd626ea5c25bfa4695170bbb3ed5f5260e1e7 extends Twig_Template
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
        echo "Bonjour,

Votre demande d’inscription a bien été prise en compte. Pour confirmer la validité de votre email veuillez cliquer
ici : ";
        // line 4
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("flair_user_confirmation_email", array("token" => (isset($context["tokenUrl"]) ? $context["tokenUrl"] : null)));
        echo "

Cordialement,
L'équipe Mise-en-concurrence
";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Mails:confirmationEmail.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Mails:confirmationEmail.txt.twig", "/var/www/src/Flair/UserBundle/Resources/views/Mails/confirmationEmail.txt.twig");
    }
}
