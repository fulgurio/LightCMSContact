<?php
/*
 * This file is part of the LightCMSContactBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSContactBundle\Mailer;

use Fulgurio\LightCMSContactBundle\Mailer\AbstractMailer;

/**
 * Admin mailer
 *
 * @author Vincent Guerard <v.guerard@fulgurio.net>
 */
class ContactMailer extends AbstractMailer
{
    /**
     * Contact form email sender
     *
     * @param array $data
     */
    public function sendMessage($data, $emails)
    {
        $subject = $this->templating->render(
                $this->parameters['contact.subject'], $data
        );
        $bodyText = $this->templating->render(
                $this->parameters['contact.textTemplate'], $data
        );
        $bodyHTML = $this->templating->render(
                $this->parameters['contact.htmlTemplate'], $data
        );
        $fromEmail = $this->parameters['contact.from'] != ''
                ? $this->parameters['contact.from']
                : $data['email'];
        $toEmail = trim($emails) == ''
                ? $this->parameters['contact.to']
                : preg_split('/,/', $emails)
            ;
        $this->sendEmailMessage(
                $fromEmail,
                $toEmail,
                $subject,
                $bodyHTML,
                $bodyText
        );
    }
}