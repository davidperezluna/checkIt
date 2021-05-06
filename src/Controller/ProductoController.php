<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Producto;

class ProductoController extends AbstractController
{
    /**
     * @Route("/producto", name="producto")
     */
    public function index(): Response
    {
        $productoR = $this->getDoctrine()->getRepository(Producto::class);
        $productos = $productoR->findAll();
        return $this->render('producto/index.html.twig', [
            'productos' => $productos,
        ]);
    }

    /**
     * @Route("/producto/{id}", name="producto_show")
     */
    public function show($id): Response
    {
        $productoR = $this->getDoctrine()->getRepository(Producto::class);
        $producto = $productoR->find($id);
        return $this->render('producto/show.html.twig', [
            'producto' => $producto,
        ]);
    }




    /**
    * @Route("/search/producto", name="search_producto", methods={"POST"})
    */
    public function searchProducto(Request $request): Response
    {
      
        $stringBusqueda = $request->request->get("stringBusqueda");
        
        $productoRepository = $this->getDoctrine()->getRepository(Producto::class);
        $productos = $productoRepository->findByString($stringBusqueda);

        return $this->render('producto/search.html.twig', [
            'productos' => $productos,
            'stringBusqueda' => $stringBusqueda,
        ]);

        
    }
}
