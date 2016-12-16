<?php

/* ::base.html.twig */
class __TwigTemplate_dc72ef5cbcc816f02b979d6c9b4e4548ca3ab6321208791fb024ac35401fe17c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
            'inlineScript' => array($this, 'block_inlineScript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <title>Mise en concurrence</title>
        <link rel=\"icon\" type=\"image/x-icon\" href=\"/favicon.ico?v1\" />

        ";
        // line 9
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "c3185e8_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_assetic_c3185e8_0") : $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("css/style_layout_1.css");
            // line 10
            echo "            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
        ";
        } else {
            // asset "c3185e8"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_assetic_c3185e8") : $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("css/style.css");
            echo "            <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" />
        ";
        }
        unset($context["asset_url"]);
        // line 12
        echo "        <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("stylesheets/select2.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("jquery-ui/jquery-ui.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("font-awesome-4.5.0/css/font-awesome.min.css"), "html", null, true);
        echo "\">
        <script type=\"text/javascript\" src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("jquery/jquery.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("jquery/jquery.cookie.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("jquery/jquery.fancybox.js"), "html", null, true);
        echo "\"></script>

    </head>

    <body>
        <div id=\"global-container\">
            <header class=\"inner\">
                <a class=\"logo\" href=\"";
        // line 24
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("Homepage");
        echo "\">
                    <img src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("images/header-logo.png"), "html", null, true);
        echo "\">
                </a>

                <div class=\"button_container\">
                    ";
        // line 29
        if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_USER")) {
            // line 30
            echo "                        ";
            if ( !array_key_exists("hideInscription", $context)) {
                // line 31
                echo "                            <a href=\"";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("flair_user_inscription_organisme");
                echo "\" class=\"btn orange\">S'inscrire</a>
                        ";
            }
            // line 33
            echo "                        <a href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("login");
            echo "\" class=\"btn\">Se connecter</a>
                    ";
        } else {
            // line 35
            echo "                        <span>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array()), "nom", array()), "html", null, true);
            echo "</span>
                        <a href=\"";
            // line 36
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("logout");
            echo "\" class=\"btn\">Se déconnecter</a>
                    ";
        }
        // line 38
        echo "                </div>

                ";
        // line 40
        if ( !array_key_exists("active", $context)) {
            $context["active"] = null;
        }
        // line 41
        echo "
                ";
        // line 42
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ORGANISME")) {
            // line 43
            echo "                    ";
            $this->loadTemplate("::menu/organisme.html.twig", "::base.html.twig", 43)->display($context);
            // line 44
            echo "                ";
        } elseif ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_PRESTATAIRE")) {
            // line 45
            echo "                     ";
            $this->loadTemplate("::menu/prestataire.html.twig", "::base.html.twig", 45)->display($context);
            // line 46
            echo "                ";
        }
        // line 47
        echo "            </header>

            <div class=\"container\">
                ";
        // line 50
        $this->displayBlock('body', $context, $blocks);
        // line 51
        echo "            </div>
        </div>

        <footer>
            <div class=\"inner clearfix\">
                <ul class=\"copyright\">
                    <li>Mise-en-concurrence.com &copy; ";
        // line 57
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo "</li>
                </ul>
                <ul class=\"footer_menu\">
                    <li><a href=\"mailto:contact@mise-en-concurrence.fr\">Nous contacter</a></li>
                    <li><a href=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("CGU.pdf"), "html", null, true);
        echo "\">CGU</a></li>
                    <li><a href=\"";
        // line 62
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("FAQ");
        echo "\">FAQ</a></li>
                    <li><a href=\"";
        // line 63
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getUrl("Mentions_legales");
        echo "\">Mentions légales</a></li>
                    <li><a id=\"js-scroll-top\" href=\"#\" class=\"btn orange no-radius black bold\">Haut de page</a></li>
                </ul>
            </div>
        </footer>


        <script type=\"text/javascript\" src=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/jquery-ui-1.10.3.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/jquery-ui-datepicker.fr.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/jquery-placeholder.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/jquery-datatables.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("bundles/fosjsrouting/js/router.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_js_routing_js", array("callback" => "fos.Router.setData"));
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/select2.min.js"), "html", null, true);
        echo "\"></script>



        ";
        // line 80
        $this->displayBlock('javascripts', $context, $blocks);
        // line 88
        echo "        ";
        $this->displayBlock('inlineScript', $context, $blocks);
        // line 89
        echo "    </body>
</html>
";
    }

    // line 50
    public function block_body($context, array $blocks = array())
    {
    }

    // line 80
    public function block_javascripts($context, array $blocks = array())
    {
        // line 81
        echo "            ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "5829438_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_assetic_5829438_0") : $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/main_main_1.js");
            // line 85
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
            ";
            // asset "5829438_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_assetic_5829438_1") : $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/main_categories_2.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
            ";
        } else {
            // asset "5829438"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_assetic_5829438") : $this->env->getExtension('Symfony\Bundle\TwigBundle\Extension\AssetsExtension')->getAssetUrl("javascripts/main.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
            ";
        }
        unset($context["asset_url"]);
        // line 87
        echo "        ";
    }

    // line 88
    public function block_inlineScript($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  263 => 88,  259 => 87,  239 => 85,  234 => 81,  231 => 80,  226 => 50,  220 => 89,  217 => 88,  215 => 80,  208 => 76,  204 => 75,  200 => 74,  196 => 73,  192 => 72,  188 => 71,  184 => 70,  174 => 63,  170 => 62,  166 => 61,  159 => 57,  151 => 51,  149 => 50,  144 => 47,  141 => 46,  138 => 45,  135 => 44,  132 => 43,  130 => 42,  127 => 41,  123 => 40,  119 => 38,  114 => 36,  109 => 35,  103 => 33,  97 => 31,  94 => 30,  92 => 29,  85 => 25,  81 => 24,  71 => 17,  67 => 16,  63 => 15,  59 => 14,  55 => 13,  50 => 12,  36 => 10,  32 => 9,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "::base.html.twig", "/var/www/app/Resources/views/base.html.twig");
    }
}
