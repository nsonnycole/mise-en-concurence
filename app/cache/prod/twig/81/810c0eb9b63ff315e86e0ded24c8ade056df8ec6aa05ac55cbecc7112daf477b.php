<?php

/* ::form/default_form_theme.html.twig */
class __TwigTemplate_7d7515232b9be34d6bae1fe234fa1b6f8891152b95567cc8705245044db668e1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'form_label' => array($this, 'block_form_label'),
            'form_row' => array($this, 'block_form_row'),
            'radio_widget' => array($this, 'block_radio_widget'),
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'form_errors' => array($this, 'block_form_errors'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('form_label', $context, $blocks);
        // line 22
        echo "
";
        // line 23
        $this->displayBlock('form_row', $context, $blocks);
        // line 32
        echo "
";
        // line 33
        $this->displayBlock('radio_widget', $context, $blocks);
        // line 39
        echo "
";
        // line 40
        $this->displayBlock('choice_widget_expanded', $context, $blocks);
        // line 49
        echo "
";
        // line 50
        $this->displayBlock('form_errors', $context, $blocks);
    }

    // line 1
    public function block_form_label($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        ob_start();
        // line 3
        echo "        ";
        if ( !((isset($context["label"]) ? $context["label"] : null) === false)) {
            // line 4
            echo "            ";
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " control-label"))));
            // line 5
            echo "            ";
            if ( !(isset($context["compound"]) ? $context["compound"] : null)) {
                // line 6
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("for" => (isset($context["id"]) ? $context["id"] : null)));
                // line 7
                echo "            ";
            }
            // line 8
            echo "            ";
            if ((isset($context["required"]) ? $context["required"] : null)) {
                // line 9
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : null), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " required"))));
                // line 10
                echo "            ";
            }
            // line 11
            echo "            ";
            if ( !twig_test_empty((isset($context["label"]) ? $context["label"] : null))) {
                // line 12
                echo "                <label";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : null));
                foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                    echo " ";
                    echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                    echo "=\"";
                    echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                    echo "\"";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo ">
                ";
                // line 13
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["label"]) ? $context["label"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
                echo "
                ";
                // line 14
                if ((isset($context["required"]) ? $context["required"] : null)) {
                    // line 15
                    echo "                    <span class=\"required-flag\">*</span>
                ";
                }
                // line 17
                echo "                </label>
            ";
            }
            // line 19
            echo "        ";
        }
        // line 20
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 23
    public function block_form_row($context, array $blocks = array())
    {
        // line 24
        echo "    <div class=\"control-group\">
        ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'label');
        echo "
        <div class=\"controls\">
            ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "
            ";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "
        </div>
    </div>
";
    }

    // line 33
    public function block_radio_widget($context, array $blocks = array())
    {
        // line 34
        echo "    <label class=\"radio\">
        <input type=\"radio\" ";
        // line 35
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " />
        ";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["label"]) ? $context["label"] : null), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : null)), "html", null, true);
        echo "
    </label>
";
    }

    // line 40
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        // line 41
        echo "    ";
        ob_start();
        // line 42
        echo "        <div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
            ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 44
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'widget');
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 50
    public function block_form_errors($context, array $blocks = array())
    {
        // line 51
        echo "    ";
        ob_start();
        // line 52
        echo "        ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : null)) > 0)) {
            // line 53
            echo "            <ul class=\"error-list\">
                ";
            // line 54
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 55
                echo "                    <li>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute($context["error"], "message", array())), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "            </ul>
        ";
        }
        // line 59
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "::form/default_form_theme.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  226 => 59,  222 => 57,  213 => 55,  209 => 54,  206 => 53,  203 => 52,  200 => 51,  197 => 50,  191 => 46,  182 => 44,  178 => 43,  173 => 42,  170 => 41,  167 => 40,  160 => 36,  148 => 35,  145 => 34,  142 => 33,  134 => 28,  130 => 27,  125 => 25,  122 => 24,  119 => 23,  114 => 20,  111 => 19,  107 => 17,  103 => 15,  101 => 14,  97 => 13,  81 => 12,  78 => 11,  75 => 10,  72 => 9,  69 => 8,  66 => 7,  63 => 6,  60 => 5,  57 => 4,  54 => 3,  51 => 2,  48 => 1,  44 => 50,  41 => 49,  39 => 40,  36 => 39,  34 => 33,  31 => 32,  29 => 23,  26 => 22,  24 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "::form/default_form_theme.html.twig", "/var/www/app/Resources/views/form/default_form_theme.html.twig");
    }
}
