<?php
/*
 * This file is part of the LightCMSContactBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSContactBundle\Form\Type;

use Fulgurio\LightCMSBundle\Form\Type\AdminPageType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminContactFormPageType extends AdminPageType
{
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('emails', 'text', array(
                'mapped' => FALSE
                )
            );
    }
}