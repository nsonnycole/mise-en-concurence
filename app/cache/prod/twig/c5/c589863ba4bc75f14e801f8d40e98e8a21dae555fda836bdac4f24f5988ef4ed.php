<?php

/* IvoryCKEditorBundle:Form:ckeditor_widget.html.twig */
class __TwigTemplate_d7575aa6cb407b6b7cb8d0c32639b31ad37152b3e396eeef810a40872a08023c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'ckeditor_widget' => array($this, 'block_ckeditor_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('ckeditor_widget', $context, $blocks);
    }

    public function block_ckeditor_widget($context, array $blocks = array())
    {
        // line 2
        echo "    <textarea ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">";
        echo (isset($context["value"]) ? $context["value"] : null);
        echo "</textarea>

    ";
        // line 4
        if ((isset($context["enable"]) ? $context["enable"] : null)) {
            // line 5
            echo "        <script type=\"text/javascript\">
            var CKEDITOR_BASEPATH = '";
            // line 6
            echo twig_escape_filter($this->env, (isset($context["base_path"]) ? $context["base_path"] : null), "html", null, true);
            echo "';
        </script>

        <script type=\"text/javascript\" src=\"";
            // line 9
            echo twig_escape_filter($this->env, (isset($context["js_path"]) ? $context["js_path"] : null), "html", null, true);
            echo "\"></script>

        <script type=\"text/javascript\">
            if (CKEDITOR.instances['";
            // line 12
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "']) {
                delete CKEDITOR.instances['";
            // line 13
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "'];
            }

            ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["plugins"]) ? $context["plugins"] : null));
            foreach ($context['_seq'] as $context["plugin_name"] => $context["plugin"]) {
                // line 17
                echo "                CKEDITOR.plugins.addExternal('";
                echo twig_escape_filter($this->env, $context["plugin_name"], "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, $this->getAttribute($context["plugin"], "path", array()), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, $this->getAttribute($context["plugin"], "filename", array()), "html", null, true);
                echo "');
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['plugin_name'], $context['plugin'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "
            CKEDITOR.replace('";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "', ";
            echo (isset($context["config"]) ? $context["config"] : null);
            echo ");
        </script>
    ";
        }
    }

    public function getTemplateName()
    {
        return "IvoryCKEditorBundle:Form:ckeditor_widget.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  81 => 20,  78 => 19,  65 => 17,  61 => 16,  55 => 13,  51 => 12,  45 => 9,  39 => 6,  36 => 5,  34 => 4,  26 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "IvoryCKEditorBundle:Form:ckeditor_widget.html.twig", "/var/www/vendor/egeloen/ckeditor-bundle/Ivory/CKEditorBundle/Resources/views/Form/ckeditor_widget.html.twig");
    }
}
