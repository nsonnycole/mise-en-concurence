<?php

/* FlairUserBundle:Security:login.html.twig */
class __TwigTemplate_b789a0a9b70b561e7f1e0c1bbc0c03623e8e9bf7bb44061001bf3da62e4a6fa9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FlairUserBundle:Security:login.html.twig", 1);
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
    <div class=\"prefix_1\">
        <div class=\"title title-table\">
            <h2 class=\"left-bar\">
                Connexion
            </h2>

            <div class=\"btn-bar right\">
                <a href=\"";
        // line 12
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("Homepage");
        echo "\" class=\"btn orange no-radius\"><i class=\"fa fa-undo\"></i> Retour</a>
                <div class=\"corner\"></div>
            </div>
        </div>

        <form class=\"form-horizontal\" id=\"login-form\" action=\"";
        // line 17
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("login_check");
        echo "\" method=\"post\">

            ";
        // line 19
        if ((array_key_exists("error", $context) &&  !(null === (isset($context["error"]) ? $context["error"] : null)))) {
            // line 20
            echo "                <div class=\"error\">
                    <p>Le nom d'utilisateur et le mot de passe ne correspondent pas</p>
                </div>
            ";
        }
        // line 24
        echo "
            <div class=\"control-group\">
                <label class=\"control-label required\" for=\"username\">Email :</label>
                <div class=\"controls\">
                    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : null), "html", null, true);
        echo "\" required=\"required\">
                </div>
            </div>

            <div class=\"control-group\">
                <label class=\"control-label required\" for=\"password\">Mot de passe :</label>
                <div class=\"controls\">
                    <input type=\"password\" id=\"password\" name=\"_password\" required=\"required\">
                </div>
            </div>

            <div class=\"control-group\">
                <label class=\"control-label\" for=\"remember_me\">Se souvenir de moi</label>
                <div class=\"controls\">
                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\">
                </div>
            </div>

            <div class=\"controls\">
                <input type=\"submit\" id=\"_submit\" class=\"btn orange\" name=\"_submit\" value=\"Connexion\">
                <a class=\"btn\" href=\"";
        // line 48
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("flair_user_password_forget");
        echo "\">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 48,  68 => 28,  62 => 24,  56 => 20,  54 => 19,  49 => 17,  41 => 12,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Security:login.html.twig", "/var/www/src/Flair/UserBundle/Resources/views/Security/login.html.twig");
    }
}
