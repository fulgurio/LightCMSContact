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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


class ContactFormPageType extends AbstractType
{
    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', 'text', array(
                'required' => TRUE,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'fulgurio.lightCMSContact.contact.lastname.not_blank')
                    )
                )
            ))
            ->add('email', 'email', array(
                'required' => TRUE,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'fulgurio.lightCMSContact.contact.email.not_blank')
                    )
                )
            ))
            ->add('message', 'text', array(
                'required' => TRUE,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'fulgurio.lightCMSContact.contact.message.not_blank')
                    )
                )
            ));
    }

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'contact';
    }
}