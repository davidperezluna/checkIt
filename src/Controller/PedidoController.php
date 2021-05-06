<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Producto;
use App\Entity\Cliente;
use App\Entity\EstadoPedido;
use App\Entity\ProductosPedido;
use App\Form\PedidoType;
use App\Repository\PedidoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pedido")
 */
class PedidoController extends AbstractController
{
    /**
     * @Route("/", name="pedido_index", methods={"GET"})
     */
    public function index(PedidoRepository $pedidoRepository): Response
    {
        return $this->render('pedido/index.html.twig', [
            'pedidos' => $pedidoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pedido_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $productoId = $request->request->get("productoId");
        $cantidad = $request->request->get("cantidad");
        $productoRepository = $this->getDoctrine()->getRepository(Producto::class);
        $pedidoRepository = $this->getDoctrine()->getRepository(Pedido::class);
        $clienteRepository = $this->getDoctrine()->getRepository(Cliente::class);
        $estadoPedidoRepository = $this->getDoctrine()->getRepository(EstadoPedido::class);
        $em = $this->getDoctrine()->getManager();
        $producto = $productoRepository->find($productoId);
        $cliente = $clienteRepository->findOneByResponzable($this->getUser()->getId());
        $pedido = $pedidoRepository->findOneBy(
            array(
                'estadoPedido' => 2,
                'cliente' => $cliente->getId()
            )
        );
        $fecha = new \DateTime("now");

        if ($pedido) {
            $pedido->setCliente($cliente);
            $pedido->setFechaInicial($fecha);
        } else {
            $pedido = new Pedido();
            $pedido->setCliente($cliente);
            $pedido->setFechaInicial($fecha);
            $estadoPedido = $estadoPedidoRepository->find(2);
            $pedido->setEstadoPedido($estadoPedido);
            $em->persist($pedido);
        }

        $productosPedido = new ProductosPedido();
        $productosPedido->setProducto($producto);
        $productosPedido->setCantidad($cantidad);
        $productosPedido->setPedido($pedido);

        $em->persist($productosPedido);

        $em->flush();
        return $this->redirectToRoute('producto');
    }

    /**
     * @Route("/{id}", name="pedido_show", methods={"GET"})
     */
    public function show(Pedido $pedido): Response
    {
        return $this->render('pedido/show.html.twig', [
            'pedido' => $pedido,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pedido_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pedido $pedido): Response
    {
        $form = $this->createForm(PedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pedido_index');
        }

        return $this->render('pedido/edit.html.twig', [
            'pedido' => $pedido,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedido_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pedido $pedido): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pedido->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pedido_index');
    }
}
