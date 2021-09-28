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

/* main.html.twig */
class __TwigTemplate_8617151b8ba62a421511b267c79b72de9886f036f1d71b706960fc5f52116636 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html>
<head>
    <!-- In Twig betekenen de twee accolades \"echo\", ze tonen dus de inhoud van de variabele \"title\" -->
    <title>";
        // line 4
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
</head>
</html>
<body>
    <h1>Dit komt uiteindelijk op elke pagina terug</h1>
    <p>
        In onderstaande \"BLOCK\" worden de afzonderlijke twig files opgenomen,
        je kunt oneindig veel \"blocks\" op een pagina hebben
    </p>
    <div style=\"padding: 20px;\">
        ";
        // line 14
        $this->displayBlock('content', $context, $blocks);
        // line 16
        echo "    </div>
</body>

";
    }

    // line 14
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ??? Huh
        ";
    }

    public function getTemplateName()
    {
        return "main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 14,  58 => 16,  56 => 14,  43 => 4,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.html.twig", "/Users/rene/Documents/Development/Web/opleidingen/algemeen/templates/main.html.twig");
    }
}
