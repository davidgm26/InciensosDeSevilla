<?php

namespace App\Controller;

use App\Dto\PedidoDto;
use App\Dto\ProductoDto;
use App\Entity\Pedido;
use App\Entity\Usuario;
use App\Form\PedidoType;
use App\Repository\PedidoRepository;
use App\Service\PedidoService;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/pedido')]
final class PedidoController extends AbstractController
{

    public function __construct(
        private PedidoService $pedidoService,
        private Security $security,
    ){}

    #[Route('/all',name: 'get_all_pedidos', methods: ['GET'])]
    public function getAllPedidos(): Response
    {
        $listaPedidos = $this->pedidoService->getPedidos();
        $listaPedidosDto = array_map(fn($pedido)=> PedidoDto::fromPedido($pedido), $listaPedidos);
        return $this->json($listaPedidosDto, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'get_pedido_por_id', methods: ['GET'])]
    public function getPedidoPorId(Pedido $pedido):JsonResponse
    {

        $pedidoDto = PedidoDto::fromPedido($pedido);
        return $this->json($pedidoDto);
    }
    #[Route('/new', name: 'app_pedido_new', methods: ['GET', 'POST'])]
    public function new(Request $request) : JsonResponse
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        $requestData = json_decode($request->getContent(), true);
        $pedido = $this->pedidoService->createPedido($requestData,$usuario);
        $pedidoDto = PedidoDto::fromPedido($pedido);
        return $this->json($pedidoDto);
    }

    #[Route('/{id}/edit', name: 'app_pedido_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pedido $pedido, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pedido_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pedido/edit.html.twig', [
            'pedido' => $pedido,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pedido_delete', methods: ['POST'])]
    public function delete(Request $request, Pedido $pedido, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pedido->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pedido_index', [], Response::HTTP_SEE_OTHER);
    }

}
