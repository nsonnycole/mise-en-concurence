<?php

/* FlairUserBundle:Categories:organisme.html.twig */
class __TwigTemplate_38b65ad5b4dde8deca878b1a8499c493a69562417558809646f8516482d196e6 extends Twig_Template
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
        echo "<div class=\"js_categories\" data-url=\"";
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true);
        echo "\">

    <div class=\"control-group\">
        ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelOne", array()), 'label');
        echo "
        <div class=\"controls\">
            ";
        // line 6
        if ( !array_key_exists("hideErrors", $context)) {
            // line 7
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelOne", array()), 'errors');
            echo "
            ";
        }
        // line 9
        echo "
            ";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelOne", array()), 'widget');
        echo "
        </div>
    </div>

    ";
        // line 14
        if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelTwo", array(), "any", true, true)) {
            // line 15
            echo "        <div class=\"control-group\">
            ";
            // line 16
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelTwo", array()), 'label');
            echo "
            <div class=\"controls\">
                ";
            // line 18
            if ( !array_key_exists("hideErrors", $context)) {
                // line 19
                echo "                    ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelTwo", array()), 'errors');
                echo "
                ";
            }
            // line 21
            echo "
                ";
            // line 22
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "categorieLevelTwo", array()), 'widget');
            echo "
            </div>
        </div>
    ";
        }
        // line 26
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "FlairUserBundle:Categories:organisme.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 26,  70 => 22,  67 => 21,  61 => 19,  59 => 18,  54 => 16,  51 => 15,  49 => 14,  42 => 10,  39 => 9,  33 => 7,  31 => 6,  26 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "FlairUserBundle:Categories:organisme.html.twig", "/var/www/src/Flair/UserBundle/Resources/views/Categories/organisme.html.twig");
    }
}
