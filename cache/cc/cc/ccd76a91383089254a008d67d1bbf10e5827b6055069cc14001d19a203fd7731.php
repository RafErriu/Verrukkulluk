<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* gerecht.html.twig */
class __TwigTemplate_87ad810a931773da0a443cee54b2bfc6bde93d5b7cee880f11b666495dadef47 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "main.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("main.html.twig", "gerecht.html.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    ";
        // line 7
        echo "
    ";
        // line 9
        echo "    <h2>???";
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</h2>

    ";
        // line 12
        echo "
";
    }

    public function getTemplateName()
    {
        return "gerecht.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 12,  55 => 9,  52 => 7,  50 => 6,  46 => 5,  35 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "gerecht.html.twig", "/Users/rene/Documents/Development/Web/opleidingen/algemeen/templates/gerecht.html.twig");
    }
}
