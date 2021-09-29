<?php

namespace Kreemer\UX\AutoCompleteJS\Twig;

use Kreemer\UX\AutoCompleteJS\Model\AutoCompleteModel;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_autocomplete', [$this, 'renderAutoComplete'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param mixed[] $attributes
     *
     * @throws \Twig\Error\RuntimeError
     */
    public function renderAutoComplete(Environment $env, AutoCompleteModel $autoCompleteModel, array $attributes = []): string
    {
        $autoCompleteModel->setAttributes(array_merge($autoCompleteModel->getAttributes(), $attributes));

        // @phpstan-ignore-next-line
        $config = twig_escape_filter($env, json_encode($autoCompleteModel, JSON_THROW_ON_ERROR), 'html_attr');

        $html = '
            <div
                data-controller="'.trim($autoCompleteModel->getDataController().' kreemer--ux-autocomplete-js--autocomplete').'"
                data-kreemer--ux-autocomplete-js--autocomplete-config-value="'.$config.'"
        ';

        $html .= $this->extractAttributes($autoCompleteModel->getAttributes());
        $html = trim($html).'><input type="text" data-kreemer--ux-autocomplete-js--autocomplete-target="input" ';
        $html .= $this->extractAttributes($autoCompleteModel->getInputAttributes());

        $html = trim($html).'/><input type="hidden" data-kreemer--ux-autocomplete-js--autocomplete-target="data" ';
        $html .= $this->extractAttributes($autoCompleteModel->getDataAttributes());

        return trim($html).'/></div>';
    }

    /**
     * @param array<string, mixed> $attributes
     */
    private function extractAttributes(array $attributes): string
    {
        $html = '';
        foreach ($attributes as $name => $value) {
            if ('data-controller' === $name) {
                continue;
            }

            if (true === $value) {
                $html .= $name.'="'.$name.'" ';
            } elseif (false !== $value) {
                $html .= $name.'="'.$value.'" ';
            }
        }

        return $html;
    }
}
