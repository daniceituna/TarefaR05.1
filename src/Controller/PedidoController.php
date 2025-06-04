<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\PedidoRepository;
use App\Entity\Pedido;
use App\OptionsResolver\PedidoOptionsResolver;
use InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/api", "api_")]
final class PedidoController extends AbstractController
{
    #[Route('/pedido', name: 'app_pedido', methods: ["GET"])]
    public function index(PedidoRepository $pedidoRepository): JsonResponse
    {
        $pedidos = $pedidoRepository->findAll();

        return $this->json($pedidos);
    }

    #[Route("/pedidos/{id}", "get_pedido", methods: ["GET"])]
    public function getPedido(Pedido $pedido): JsonResponse
    {
        return $this->json($pedido);
    }

    #[Route("/pedidos", "create_pedido", methods: ["POST"])]
    public function createPedido(Request $request, PedidoRepository $pedidoRepository, ValidatorInterface $validator, PedidoOptionsResolver $pedidoOptionsResolver): JsonResponse
    {
        try{
            $requestBody = json_decode($request->getContent(), true);

            $fields = $pedidoOptionsResolver
                ->configureDireccion(true)
                ->configureTotal(true)
                ->configureCantidad(true)
                ->resolve($requestBody);
                
                $pedido = new Pedido();
                $pedido->setDireccion($requestBody["direccion"]);
                $pedido->setTotal($requestBody["total"]);
                $pedido->setCantidad($requestBody["cantidad"]);

                $errors = $validator->validate($pedido);
                if (count($errors) > 0) {
                    throw new InvalidArgumentException((string) $errors);
                }

            $pedidoRepository->save($pedido, true);

            return $this->json($pedido, status: Response::HTTP_CREATED);

        }catch(Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[Route("/pedidos/{id}", "delete_pedido", methods: ["DELETE"])]
    public function deletePedido(Pedido $pedido, PedidoRepository $pedidoRepository)
    {
        $pedidoRepository->remove($pedido, true);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

     #[Route("/pedidos/{id}", "update_pedido", methods: ["PATCH", "PUT"])]
    public function updatePedido(Pedido $pedido, Request $request, ValidatorInterface $validator, PedidoOptionsResolver $pedidoOptionsResolver, EntityManagerInterface $em)
    {
        try{
            $requestBody = json_decode($request->getContent(), true);
            $isPutMethod = $request->getMethod() === "PUT";

            $fields = $pedidoOptionsResolver
                ->configureDireccion($isPutMethod)
                ->configureTotal($isPutMethod)
                ->configureCantidad($isPutMethod)
                ->resolve($requestBody);
                
            foreach ($fields as $field => $value) {
                switch ($field) {
                    case "direccion":
                        $pedido->setDireccion($value);
                        break;
                    case "total":
                        $pedido->setTotal($value);
                        break;
                    case "cantidad":
                        $pedido->setCantidad($value);
                        break;
                }
            };

                $errors = $validator->validate($pedido);
                if (count($errors) > 0) {
                    throw new InvalidArgumentException((string) $errors);
                }

            return $this->json($pedido);

        } catch(Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
