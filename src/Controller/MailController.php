<?php

namespace App\Controller;

use App\Service\MailService;
use App\Service\PedidoService;
use App\Service\UsuarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;


#[Route('/api/mail')]
final class MailController extends AbstractController
{

    public function __construct(
        private PedidoService $pedidoService,
        private Security $security,
        private MailService $mailService,
        private UsuarioService $usuarioService,
    ){}

    #[Route('/new', name: 'send_mail', methods: ['GET'])]
    public function sendMail():JsonResponse
    {
        $number =  $this->usuarioService->crearNumeroDeVerificacion();
        $this->mailService->sendMail("davidgama260402@gmail.com",$number);
        return $this->json("Mensaje enviado ". $number);
    }



}