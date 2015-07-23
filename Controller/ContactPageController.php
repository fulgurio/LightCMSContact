<?php
/*
 * This file is part of the LightCMSContactBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSContactBundle\Controller;

use Fulgurio\LightCMSBundle\Entity\Page;
use Fulgurio\LightCMSContactBundle\Form\Handler\ContactFormPageHandler;
use Fulgurio\LightCMSContactBundle\Form\Type\ContactFormPageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller displaying front page
 */
class ContactPageController extends Controller
{
    /**
     * Page
     *
     * @var Page
     */
    protected $page;


    /**
     * Display page
     */
    public function contactAction()
    {
        // Page filter : only published page are loaded (menu, or any where in the page)
        $filter = $this->getDoctrine()->getManager()->getFilters()->enable('page');
        $filter->setParameter('status', 'published');
        $models = $this->container->getParameter('fulgurio_light_cms.models');

        $templateName = isset($models[$this->page->getModel()]['front']['template']) ? $models[$this->page->getModel()]['front']['template'] : 'FulgurioLightCMSBundle:models:standardFront.html.twig';
        $pageRoot = $this->page->getSlug() == '' ? $this->page : $this->getDoctrine()->getRepository('FulgurioLightCMSBundle:Page')->findOneByFullpath('');

        $form = $this->createForm(new ContactFormPageType());
        $formHandler = new ContactFormPageHandler(
                $form,
                $this->getRequest(),
                $this->get('fulgurio_lightcmscontact.contact_mailer')
        );
        if ($formHandler->process($this->page))
        {
            $this->get('session')->getFlashBag()->add('success',
                    $this->get('translator')->trans(
                            'fulgurio.lightCMSContact.contact.success'
                    )
            );
            return $this->redirect($this->getRequest()->getUri());
        }

        return $this->render($templateName, array(
            'pageRoot' => $pageRoot,
            'currentPage' => $this->page,
            'form' => $form->createView()
        ));
    }

    /**
     * $page setter
     *
     * @param Page $page
     */
    final public function setPage(Page $page)
    {
        $this->page = $page;
    }
}