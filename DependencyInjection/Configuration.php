<?php
/*
 * This file is part of the LightCMSContactBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fulgurio_light_cms_contact');

        $this->addEmailsSection($rootNode);

        return $treeBuilder;
    }


    /**
     * Emails configuration
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addEmailsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('email')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('contact')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('from')->defaultValue('')->end()
                            ->end()
                            ->children()
                                ->scalarNode('to')->defaultValue('')->end()
                            ->end()
                            ->children()
                                ->scalarNode('subject')->defaultValue('FulgurioLightCMSContactBundle:Contact:subject.txt.twig')->end()
                            ->end()
                            ->children()
                                ->scalarNode('text')->defaultValue('FulgurioLightCMSContactBundle:Contact:email.txt.twig')->end()
                            ->end()
                            ->children()
                                ->scalarNode('html')->defaultValue('FulgurioLightCMSContactBundle:Contact:email.html.twig')->end()
                            ->end()
                        ->end()
                    ->end();
    }
}
