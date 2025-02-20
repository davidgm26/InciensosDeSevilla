<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{

    public function __construct(
        private MailerInterface $mailer,
    ){}

    public function sendMail(string $email, string $subject, string $message):void
    {
        $emailN = (new Email())
            ->from("designswiki@gmail.com")
            ->to($email)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($emailN);

    }

}