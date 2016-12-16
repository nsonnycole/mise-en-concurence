<?php

/* FlairUserBundle:Inscription:inscriptionOrganisme.html.twig */
class __TwigTemplate_e8f9fd113023391daa88872db45fd47b777d03c47805e7d3b86c472d738ceff2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "FlairUserBundle:Inscription:inscriptionOrganisme.html.twig", 1);
        $this->blocks = array(
            '_inscription_organisme_form_cgu_row' => array($this, 'block__inscription_organisme_form_cgu_row'),
            'body' => array($this, 'block_body'),
            'inlineScript' => array($this, 'block_inlineScript'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => $this));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block__inscription_organisme_form_cgu_row($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "
    <div class=\"control-group\">
        <label class=\"control-label\" for=\"inscription_organisme_form_cgu\">
            J'accepte les <a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("CGU.pdf"), "html", null, true);
        echo "\" target=\"_blank\">CGU</a>
        </label>
        <div class=\"controls\">
            ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "
        </div>
    </div>
";
    }

    // line 17
    public function block_body($context, array $blocks = array())
    {
        // line 18
        echo "    <div class=\"inner\">
         <div class=\"title title-table\">
            <h2 class=\"left-bar\">
                Création d'un compte
            </h2>

            <div class=\"btn-bar right\">
                <div class=\"corner\"></div>
            </div>
        </div>
        <form class=\"form-horizontal registration-form\" ";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
        echo " method=\"POST\">
            <div class=\"account-information\">
                ";
        // line 30
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "email", array()), 'row');
        echo "
                ";
        // line 31
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "motdepasse", array()), 'row');
        echo "
            </div>

            <div class=\"organism-information\">
                <h2>Informations sur l'organisme</h2>

                ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "nom", array()), 'row');
        echo "
                ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "siren", array()), 'row');
        echo "
                ";
        // line 39
        echo twig_include($this->env, $context, "FlairUserBundle:Categories:organisme.html.twig", array("form" => (isset($context["form"]) ? $context["form"] : null), "url" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("Categories_inscription_organisme")), false);
        echo "
                ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "autreCategorie", array()), 'row');
        echo "
                <div class=\"hide\" id=\"rna\">
                    ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "rna", array()), 'row');
        echo "
                </div>
                <div class=\"control-group\">
                    <div class=\"controls\">
                        <div class=\"btn orange toggleShow\">
                            Suite
                        </div>
                    </div>
                </div>
                <div class=\"moreFields hide\">
                    ";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "siret", array()), 'row');
        echo "
                    ";
        // line 53
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "ape", array()), 'row');
        echo "
                    ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "prenomContact", array()), 'row');
        echo "
                    ";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "nomContact", array()), 'row');
        echo "
                    ";
        // line 56
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "adresse", array()), 'row');
        echo "
                    ";
        // line 57
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "complementAdresse", array()), 'row');
        echo "
                    ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "codePostal", array()), 'row');
        echo "
                    ";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "ville", array()), 'row');
        echo "
                    ";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "telephone", array()), 'row');
        echo "
                    ";
        // line 61
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "mobile", array()), 'row');
        echo "
                    ";
        // line 62
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "emailPartenaire", array()), 'row');
        echo "
                    ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "cgu", array()), 'row');
        echo "
                    <div class=\"control-group bt_form_row\">
                        <label>&nbsp;</label>
                        <div class=\"controls\">
                            <input type=\"submit\" class=\"btn orange\" value=\"Enregistrer\" />
                        </div>
                    </div>
                </div>
            </div>

            ";
        // line 73
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "

            <div class=\"control-group\">
                <div class=\"controls file-input\">
                    <i><span class=\"required-flag\">*</span> Champs obligatoires</i>
                </div>
            </div>
        </form>
    </div>

";
    }

    // line 85
    public function block_inlineScript($context, array $blocks = array())
    {
        // line 86
        echo "    ";
        $this->displayParentBlock("inlineScript", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        \$(function() {
            \$('.toggleShow').mousedown(toggleShow);

            function toggleShow() {
                \$('.moreFields').toggle(1000);
                \$(this).find('.ui-icon').toggleClass('ui-icon-circle-arrow-s ui-icon-circle-arrow-n');
                \$(this).find('.information').text(\"Suite\");
                if (\$(this).find('.ui-icon-circle-arrow-s').length === 0) {
                    \$(this).find('.btn').text(\"Voir moins\");

                    return false;
                }

            }

            \$('#inscription_organisme_form_autreCategorie').parent().parent().addClass('hide');
            \$('#inscription_service_organisme_form_autreCategorie').parent().parent().addClass('hide');
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Inscription:inscriptionOrganisme.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 86,  192 => 85,  177 => 73,  164 => 63,  160 => 62,  156 => 61,  152 => 60,  148 => 59,  144 => 58,  140 => 57,  136 => 56,  132 => 55,  128 => 54,  124 => 53,  120 => 52,  107 => 42,  102 => 40,  98 => 39,  94 => 38,  90 => 37,  81 => 31,  77 => 30,  72 => 28,  60 => 18,  57 => 17,  49 => 12,  43 => 9,  36 => 6,  33 => 5,  29 => 1,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Inscription:inscriptionOrganisme.html.twig", "/var/www/src/Flair/UserBundle/Resources/views/Inscription/inscriptionOrganisme.html.twig");
    }
}
