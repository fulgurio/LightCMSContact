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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FulgurioLightCMSContactExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->addEmailsConfig($container, $config['email']['contact'], 'contact');

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * Adding email data config
     *
     * @param ContainerBuilder $container
     * @param array $config
     * @param string $parameterName
     */
    private function addEmailsConfig(ContainerBuilder $container, array $config, $parameterName)
    {
        $container->setParameter('fulgurio_light_cms_contact.email.' . $parameterName . '.from', $config['from']);
        $container->setParameter('fulgurio_light_cms_contact.email.' . $parameterName . '.to', $config['to']);
        $container->setParameter('fulgurio_light_cms_contact.email.' . $parameterName . '.subject', $config['subject']);
        $container->setParameter('fulgurio_light_cms_contact.email.' . $parameterName . '.text', $config['text']);
        $container->setParameter('fulgurio_light_cms_contact.email.' . $parameterName . '.html', $config['html']);
    }
}
