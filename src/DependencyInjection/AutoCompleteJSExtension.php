<?php

namespace Kreemer\UX\AutoCompleteJS\DependencyInjection;

use Kreemer\UX\AutoCompleteJS\Builder\AutoCompleteBuilder;
use Kreemer\UX\AutoCompleteJS\Builder\AutoCompleteBuilderInterface;
use Kreemer\UX\AutoCompleteJS\Form\AutoCompleteType;
use Kreemer\UX\AutoCompleteJS\Twig\TwigExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Twig\Environment;

class AutoCompleteJSExtension extends Extension implements CompilerPassInterface
{
    /**
     * @param mixed[] $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->setDefinition('autocomplete.builder', new Definition(AutoCompleteBuilder::class))
            ->setPublic(false)
        ;

        $container
            ->setAlias(AutoCompleteBuilderInterface::class, 'autocomplete.builder')
            ->setPublic(false)
        ;

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('autocomplete.twig_extension', new Definition(TwigExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false)
            ;
        }

        $definition = new Definition(AutoCompleteType::class);
        $definition->addTag('form.type')->setArgument('$autoCompleteBuilder', $container->getDefinition('autocomplete.builder'));

        $container
            ->setDefinition('autocomplete.form', $definition)
            ->setPublic(false)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container): void
    {
        $resources = [];
        if ($container->hasParameter('twig.form.resources')) {
            /** @var string[] $resources */
            $resources = $container->getParameter('twig.form.resources');
        }

        $resources[] = '@AutoCompleteJS/theme.html.twig';

        $container->setParameter('twig.form.resources', $resources);
    }
}
