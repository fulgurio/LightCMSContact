<?php
/*
 * This file is part of the LightCMSContactBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSContactBundle\Form\Handler;

use Fulgurio\LightCMSBundle\Entity\Page;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ContactFormPageHandler
{
    /**
     * @var Symfony\Component\Form\Form
     */
    private $form;

    /**
     * @var Symfony\Component\HttpFoundation\Request
     */
    private $request;


    /**
     * Constructor
     *
     * @param Symfony\Component\Form\Form $form
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Doctrine\Bundle\DoctrineBundle\Registry $mailer
     */
    public function __construct(Form $form, Request $request, $mailer)
    {
        $this->form = $form;
        $this->request = $request;
        $this->mailer = $mailer;
    }

    /**
     * Processing form values
     *
     * @param Page $page
     * @return boolean
     */
    public function process(Page $page)
    {
        if ($this->request->getMethod() == 'POST')
        {
            $this->form->handleRequest($this->request);
            if ($this->form->isValid())
            {
                $data = $this->form->getData();
                $emails = $page->getMetaValue('emails');
                $this->mailer->sendMessage($data, $emails);
                 return TRUE;
            }
        }
        return FALSE;
    }
}