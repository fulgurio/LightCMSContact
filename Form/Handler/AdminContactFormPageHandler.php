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
use Fulgurio\LightCMSBundle\Form\Handler\AdminPageHandler;

class AdminContactFormPageHandler extends AdminPageHandler
{
    /**
     * Update page metas
     *
     * @param Page $page
     * @param array $data
     */
    protected function updatePageMetas(Page $page, array $data)
    {
        $em = $this->doctrine->getManager();
        if (isset($data['emails']))
        {
            $em->persist($this->initMetaEntity($page, 'emails', trim($data['emails'])));
        }
        parent::updatePageMetas($page, $data);
    }
}