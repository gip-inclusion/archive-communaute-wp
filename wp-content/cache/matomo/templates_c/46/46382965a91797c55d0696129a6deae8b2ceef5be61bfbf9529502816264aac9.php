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

/* @CoreHome/getDonateForm.twig */
class __TwigTemplate_531be461df290f6be52512076abd0f4178a994e51a62e466e3e926ab154aa88b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->loadTemplate("@CoreHome/_donate.twig", "@CoreHome/getDonateForm.twig", 1)->display($context);
    }

    public function getTemplateName()
    {
        return "@CoreHome/getDonateForm.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% include \"@CoreHome/_donate.twig\" %}", "@CoreHome/getDonateForm.twig", "/Users/deloo/Prestas/Beta.gouv/itou-communaute/wp-content/plugins/matomo/app/plugins/CoreHome/templates/getDonateForm.twig");
    }
}
