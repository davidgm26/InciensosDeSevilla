<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends AbstractController
{
    #[Route('/registro', name: 'registrar_usuario_cliente', methods: ['POST'])]
    public function register(Request $request,
                             UserPasswordHasherInterface $passwordHasher,
                             EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $user = new Usuario();
        $user->setUsername($data['username']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setRol(\Rol::Cliente);
        $entityManager->persist($user);
        $entityManager->flush();


        return new JsonResponse(['message' => 'Usuario registrado con éxito'], 201);
    }

}
