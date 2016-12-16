<?php

/* @WebProfiler/Collector/logger.html.twig */
class __TwigTemplate_e84ea9ddf9e2c3ffabe355d063482dcb0f5a293cbabea3badf560e8df9933427 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/logger.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["helper"] = $this;
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_toolbar($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        if ((($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array()) || $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array())) || $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countscreams", array()))) {
            // line 7
            echo "        ";
            ob_start();
            // line 8
            echo "            ";
            $context["status_color"] = (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array())) ? ("red") : ((($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array())) ? ("yellow") : (""))));
            // line 9
            echo "            ";
            $context["error_count"] = (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array()) + $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array())) + $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countscreams", array()));
            // line 10
            echo "            ";
            echo twig_include($this->env, $context, "@WebProfiler/Icon/logger.svg");
            echo "
            <span class=\"sf-toolbar-value\">";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["error_count"]) ? $context["error_count"] : null), "html", null, true);
            echo "</span>
        ";
            $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 13
            echo "
        ";
            // line 14
            ob_start();
            // line 15
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Errors</b>
                <span class=\"sf-toolbar-status sf-toolbar-status-";
            // line 17
            echo (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array())) ? ("red") : (""));
            echo "\">";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array()), 0)) : (0)), "html", null, true);
            echo "</span>
            </div>

            <div class=\"sf-toolbar-info-piece\">
                <b>Deprecated Calls</b>
                <span class=\"sf-toolbar-status sf-toolbar-status-";
            // line 22
            echo (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array())) ? ("yellow") : (""));
            echo "\">";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array()), 0)) : (0)), "html", null, true);
            echo "</span>
            </div>

            <div class=\"sf-toolbar-info-piece\">
                <b>Silenced Errors</b>
                <span class=\"sf-toolbar-status\">";
            // line 27
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countscreams", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countscreams", array()), 0)) : (0)), "html", null, true);
            echo "</span>
            </div>
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 30
            echo "
        ";
            // line 31
            echo twig_include($this->env, $context, "@WebProfiler/Profiler/toolbar_item.html.twig", array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : null), "status" => (isset($context["status_color"]) ? $context["status_color"] : null)));
            echo "
    ";
        }
    }

    // line 35
    public function block_menu($context, array $blocks = array())
    {
        // line 36
        echo "    <span class=\"label label-status-";
        echo (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array())) ? ("error") : ((($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array())) ? ("warning") : (""))));
        echo " ";
        echo ((twig_test_empty($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "logs", array()))) ? ("disabled") : (""));
        echo "\">
        <span class=\"icon\">";
        // line 37
        echo twig_include($this->env, $context, "@WebProfiler/Icon/logger.svg");
        echo "</span>
        <strong>Logs</strong>
        ";
        // line 39
        if (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array()) || $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array()))) {
            // line 40
            echo "            <span class=\"count\">
                <span>";
            // line 41
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array())) ? ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "counterrors", array())) : ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array()))), "html", null, true);
            echo "</span>
            </span>
        ";
        }
        // line 44
        echo "    </span>
";
    }

    // line 47
    public function block_panel($context, array $blocks = array())
    {
        // line 48
        echo "    <h2>Log Messages</h2>

    ";
        // line 50
        if (twig_test_empty($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "logs", array()))) {
            // line 51
            echo "        <div class=\"empty\">
            <p>No log messages available.</p>
        </div>
    ";
        } else {
            // line 55
            echo "        ";
            // line 56
            echo "        ";
            list($context["deprecation_logs"], $context["debug_logs"], $context["info_and_error_logs"]) =             array(array(), array(), array());
            // line 57
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "logs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 58
                echo "            ";
                if ((($this->getAttribute($this->getAttribute($context["log"], "context", array(), "any", false, true), "level", array(), "any", true, true) && $this->getAttribute($this->getAttribute($context["log"], "context", array(), "any", false, true), "type", array(), "any", true, true)) && twig_in_filter($this->getAttribute($this->getAttribute($context["log"], "context", array()), "type", array()), array(0 => twig_constant("E_DEPRECATED"), 1 => twig_constant("E_USER_DEPRECATED"))))) {
                    // line 59
                    echo "                ";
                    $context["deprecation_logs"] = twig_array_merge((isset($context["deprecation_logs"]) ? $context["deprecation_logs"] : null), array(0 => $context["log"]));
                    // line 60
                    echo "            ";
                } elseif (($this->getAttribute($context["log"], "priorityName", array()) == "DEBUG")) {
                    // line 61
                    echo "                ";
                    $context["debug_logs"] = twig_array_merge((isset($context["debug_logs"]) ? $context["debug_logs"] : null), array(0 => $context["log"]));
                    // line 62
                    echo "            ";
                } else {
                    // line 63
                    echo "                ";
                    $context["info_and_error_logs"] = twig_array_merge((isset($context["info_and_error_logs"]) ? $context["info_and_error_logs"] : null), array(0 => $context["log"]));
                    // line 64
                    echo "            ";
                }
                // line 65
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "
        <div class=\"sf-tabs\">
            <div class=\"tab\">
                <h3 class=\"tab-title\">Info. &amp; Errors <span class=\"badge\">";
            // line 69
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["info_and_error_logs"]) ? $context["info_and_error_logs"] : null)), "html", null, true);
            echo "</span></h3>

                <div class=\"tab-content\">
                    ";
            // line 72
            if (twig_test_empty((isset($context["info_and_error_logs"]) ? $context["info_and_error_logs"] : null))) {
                // line 73
                echo "                        <div class=\"empty\">
                            <p>There are no log messages of this level.</p>
                        </div>
                    ";
            } else {
                // line 77
                echo "                        ";
                echo $context["helper"]->getrender_table((isset($context["info_and_error_logs"]) ? $context["info_and_error_logs"] : null), true);
                echo "
                    ";
            }
            // line 79
            echo "                </div>
            </div>

            <div class=\"tab\">
                ";
            // line 85
            echo "                <h3 class=\"tab-title\">Deprecations <span class=\"badge\">";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "countdeprecations", array()), 0)) : (0)), "html", null, true);
            echo "</span></h3>

                <div class=\"tab-content\">
                    ";
            // line 88
            if (twig_test_empty((isset($context["deprecation_logs"]) ? $context["deprecation_logs"] : null))) {
                // line 89
                echo "                        <div class=\"empty\">
                            <p>There are no log messages about deprecated features.</p>
                        </div>
                    ";
            } else {
                // line 93
                echo "                        ";
                echo $context["helper"]->getrender_table((isset($context["deprecation_logs"]) ? $context["deprecation_logs"] : null), false, true);
                echo "
                    ";
            }
            // line 95
            echo "                </div>
            </div>

            <div class=\"tab\">
                <h3 class=\"tab-title\">Debug <span class=\"badge\">";
            // line 99
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["debug_logs"]) ? $context["debug_logs"] : null)), "html", null, true);
            echo "</span></h3>

                <div class=\"tab-content\">
                    ";
            // line 102
            if (twig_test_empty((isset($context["debug_logs"]) ? $context["debug_logs"] : null))) {
                // line 103
                echo "                        <div class=\"empty\">
                            <p>There are no log messages of this level.</p>
                        </div>
                    ";
            } else {
                // line 107
                echo "                        ";
                echo $context["helper"]->getrender_table((isset($context["debug_logs"]) ? $context["debug_logs"] : null));
                echo "
                    ";
            }
            // line 109
            echo "                </div>
            </div>
        </div>
    ";
        }
    }

    // line 115
    public function getrender_table($__logs__ = null, $__show_level__ = false, $__is_deprecation__ = false, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "logs" => $__logs__,
            "show_level" => $__show_level__,
            "is_deprecation" => $__is_deprecation__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 116
            echo "    ";
            $context["helper"] = $this;
            // line 117
            echo "    ";
            $context["channel_is_defined"] = $this->getAttribute(twig_first($this->env, (isset($context["logs"]) ? $context["logs"] : null)), "channel", array(), "any", true, true);
            // line 118
            echo "
    <table class=\"logs\">
        <thead>
            <tr>
                <th>";
            // line 122
            echo (((isset($context["show_level"]) ? $context["show_level"] : null)) ? ("Level") : ("Time"));
            echo "</th>
                ";
            // line 123
            if ((isset($context["channel_is_defined"]) ? $context["channel_is_defined"] : null)) {
                echo "<th>Channel</th>";
            }
            // line 124
            echo "                <th>Message</th>
            </tr>
        </thead>

        <tbody>
            ";
            // line 129
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["logs"]) ? $context["logs"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 130
                echo "                ";
                $context["css_class"] = (((isset($context["is_deprecation"]) ? $context["is_deprecation"] : null)) ? ("") : (((twig_in_filter($this->getAttribute(                // line 131
$context["log"], "priorityName", array()), array(0 => "CRITICAL", 1 => "ERROR", 2 => "ALERT", 3 => "EMERGENCY"))) ? ("status-error") : (((twig_in_filter($this->getAttribute(                // line 132
$context["log"], "priorityName", array()), array(0 => "NOTICE", 1 => "WARNING"))) ? ("status-warning") : (""))))));
                // line 134
                echo "                <tr class=\"";
                echo twig_escape_filter($this->env, (isset($context["css_class"]) ? $context["css_class"] : null), "html", null, true);
                echo "\">
                    <td class=\"font-normal text-small\">
                        ";
                // line 136
                if ((isset($context["show_level"]) ? $context["show_level"] : null)) {
                    // line 137
                    echo "                            <span class=\"colored text-bold nowrap\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["log"], "priorityName", array()), "html", null, true);
                    echo "</span>
                        ";
                }
                // line 139
                echo "                        <span class=\"text-muted nowrap newline\">";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["log"], "timestamp", array()), "H:i:s"), "html", null, true);
                echo "</span>
                    </td>

                    ";
                // line 142
                if ((isset($context["channel_is_defined"]) ? $context["channel_is_defined"] : null)) {
                    // line 143
                    echo "                        <td class=\"font-normal text-small text-bold nowrap\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["log"], "channel", array()), "html", null, true);
                    echo "</td>
                    ";
                }
                // line 145
                echo "
                    <td class=\"font-normal\">";
                // line 146
                echo $context["helper"]->getrender_log_message($this->getAttribute($context["loop"], "index", array()), $context["log"], (isset($context["is_deprecation"]) ? $context["is_deprecation"] : null));
                echo "</td>
                </tr>
            ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 149
            echo "        </tbody>
    </table>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 153
    public function getrender_log_message($__log_index__ = null, $__log__ = null, $__is_deprecation__ = false, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "log_index" => $__log_index__,
            "log" => $__log__,
            "is_deprecation" => $__is_deprecation__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 154
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "message", array()), "html", null, true);
            echo "

    ";
            // line 156
            if ((isset($context["is_deprecation"]) ? $context["is_deprecation"] : null)) {
                // line 157
                echo "        ";
                $context["stack"] = (($this->getAttribute($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array(), "any", false, true), "stack", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array(), "any", false, true), "stack", array()), array())) : (array()));
                // line 158
                echo "        ";
                $context["id"] = ("sf-call-stack-" . (isset($context["log_index"]) ? $context["log_index"] : null));
                // line 159
                echo "
        ";
                // line 160
                if ($this->getAttribute($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array(), "any", false, true), "errorCount", array(), "any", true, true)) {
                    // line 161
                    echo "            <span class=\"text-small text-bold\">(";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array()), "errorCount", array()), "html", null, true);
                    echo " times)</span>
        ";
                }
                // line 163
                echo "
        ";
                // line 164
                if ((isset($context["stack"]) ? $context["stack"] : null)) {
                    // line 165
                    echo "            <button class=\"btn-link text-small sf-toggle\" data-toggle-selector=\"#";
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "\" data-toggle-alt-content=\"Hide stack trace\">Show stack trace</button>
        ";
                }
                // line 167
                echo "
        ";
                // line 168
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["stack"]) ? $context["stack"] : null));
                foreach ($context['_seq'] as $context["index"] => $context["call"]) {
                    if (($context["index"] > 1)) {
                        // line 169
                        echo "            ";
                        if (($context["index"] == 2)) {
                            // line 170
                            echo "                <ul class=\"sf-call-stack\" id=\"";
                            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                            echo "\" class=\"hidden\">
            ";
                        }
                        // line 172
                        echo "
            ";
                        // line 173
                        if ($this->getAttribute($context["call"], "class", array(), "any", true, true)) {
                            // line 174
                            echo "                ";
                            $context["from"] = (($this->env->getExtension('Symfony\Bridge\Twig\Extension\CodeExtension')->abbrClass($this->getAttribute($context["call"], "class", array())) . "::") . $this->env->getExtension('Symfony\Bridge\Twig\Extension\CodeExtension')->abbrMethod($this->getAttribute($context["call"], "function", array())));
                            // line 175
                            echo "            ";
                        } elseif ($this->getAttribute($context["call"], "function", array(), "any", true, true)) {
                            // line 176
                            echo "                ";
                            $context["from"] = $this->env->getExtension('Symfony\Bridge\Twig\Extension\CodeExtension')->abbrMethod($this->getAttribute($context["call"], "function", array()));
                            // line 177
                            echo "            ";
                        } elseif ($this->getAttribute($context["call"], "file", array(), "any", true, true)) {
                            // line 178
                            echo "                ";
                            $context["from"] = $this->getAttribute($context["call"], "file", array());
                            // line 179
                            echo "            ";
                        } else {
                            // line 180
                            echo "                ";
                            $context["from"] = "-";
                            // line 181
                            echo "            ";
                        }
                        // line 182
                        echo "
            ";
                        // line 183
                        $context["file_name"] = ((($this->getAttribute($context["call"], "file", array(), "any", true, true) && $this->getAttribute($context["call"], "line", array(), "any", true, true))) ? (twig_last($this->env, twig_split_filter($this->env, twig_replace_filter($this->getAttribute($context["call"], "file", array()), array("\\" => "/")), "/"))) : (""));
                        // line 184
                        echo "
            <li>
                ";
                        // line 186
                        echo (isset($context["from"]) ? $context["from"] : null);
                        echo "
                ";
                        // line 187
                        if ((isset($context["file_name"]) ? $context["file_name"] : null)) {
                            // line 188
                            echo "                    <span class=\"text-small\">(called from ";
                            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\CodeExtension')->formatFile($this->getAttribute($context["call"], "file", array()), $this->getAttribute($context["call"], "line", array()), (isset($context["file_name"]) ? $context["file_name"] : null));
                            echo ")</span>
                ";
                        }
                        // line 190
                        echo "            </li>

            ";
                        // line 192
                        if (($context["index"] == (twig_length_filter($this->env, (isset($context["stack"]) ? $context["stack"] : null)) - 1))) {
                            // line 193
                            echo "                </ul>
            ";
                        }
                        // line 195
                        echo "        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['index'], $context['call'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 196
                echo "    ";
            } else {
                // line 197
                echo "        ";
                if (($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array())))) {
                    // line 198
                    echo "            <span class=\"metadata\">
                <strong>Context</strong>: ";
                    // line 199
                    echo twig_escape_filter($this->env, twig_replace_filter(twig_jsonencode_filter($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "context", array()), (64 | 256)), array("{\"" => "{ \"", "\"}" => "\" }", "\":{" => "\": {", "\":\"" => "\": \"", "\",\"" => "\", \"")), "html", null, true);
                    // line 201
                    echo "
            </span>
        ";
                }
                // line 204
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/logger.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 204,  546 => 201,  544 => 199,  541 => 198,  538 => 197,  535 => 196,  528 => 195,  524 => 193,  522 => 192,  518 => 190,  512 => 188,  510 => 187,  506 => 186,  502 => 184,  500 => 183,  497 => 182,  494 => 181,  491 => 180,  488 => 179,  485 => 178,  482 => 177,  479 => 176,  476 => 175,  473 => 174,  471 => 173,  468 => 172,  462 => 170,  459 => 169,  454 => 168,  451 => 167,  445 => 165,  443 => 164,  440 => 163,  434 => 161,  432 => 160,  429 => 159,  426 => 158,  423 => 157,  421 => 156,  415 => 154,  401 => 153,  384 => 149,  367 => 146,  364 => 145,  358 => 143,  356 => 142,  349 => 139,  343 => 137,  341 => 136,  335 => 134,  333 => 132,  332 => 131,  330 => 130,  313 => 129,  306 => 124,  302 => 123,  298 => 122,  292 => 118,  289 => 117,  286 => 116,  272 => 115,  264 => 109,  258 => 107,  252 => 103,  250 => 102,  244 => 99,  238 => 95,  232 => 93,  226 => 89,  224 => 88,  217 => 85,  211 => 79,  205 => 77,  199 => 73,  197 => 72,  191 => 69,  186 => 66,  180 => 65,  177 => 64,  174 => 63,  171 => 62,  168 => 61,  165 => 60,  162 => 59,  159 => 58,  154 => 57,  151 => 56,  149 => 55,  143 => 51,  141 => 50,  137 => 48,  134 => 47,  129 => 44,  123 => 41,  120 => 40,  118 => 39,  113 => 37,  106 => 36,  103 => 35,  96 => 31,  93 => 30,  87 => 27,  77 => 22,  67 => 17,  63 => 15,  61 => 14,  58 => 13,  53 => 11,  48 => 10,  45 => 9,  42 => 8,  39 => 7,  36 => 6,  33 => 5,  29 => 1,  27 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@WebProfiler/Collector/logger.html.twig", "/var/www/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/logger.html.twig");
    }
}
