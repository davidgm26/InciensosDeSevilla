<?php

namespace App\Service;

use App\Entity\Cliente;
use App\Entity\Usuario;
use phpDocumentor\Reflection\Types\Context;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{

    public function __construct(
        private MailerInterface $mailer,
    ){}

    public function sendMail(string $email,string $number):void
    {
        $emailN = (new TemplatedEmail())
            ->from("designswiki@gmail.com")
            ->to($email)
            ->subject('🎉 ¡Bienvenido a Inciensos de Sevilla!')
            ->htmlTemplate('propias/email/verificacion.html.twig')
            ->context([
                'number' => "$number",
                'hoy'=> new \DateTime(),
            ]);

        $this->mailer->send($emailN);
    }


    public function sendVerificationCodeEmail(Cliente $cliente,$codigo)
    {
        $email = (new TemplatedEmail())
            ->from("designswiki@gmail.com")
            ->to($cliente->getCorreo())
            ->subject("Verifica tu identidad")
            ->htmlTemplate('propias/email/verificacion.html.twig')
            ->context([
                'number' => $codigo,
            ]);
    }
}