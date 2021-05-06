<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Departamento;
use App\Entity\Municipio;
use App\Entity\Categoria;
use App\Entity\TipoMovimiento;
use App\Entity\TipoVehiculo;
use App\Entity\EstadoPedido;
use App\Entity\TipoIdentificacion;
use App\Entity\Vehiculo;
use App\Entity\Bodega;
use App\Entity\Cliente;
use App\Entity\Producto;
use App\Entity\Stock;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Radar');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Tipo Identificacion', 'fa fa-user', TipoIdentificacion::Class);
        yield MenuItem::linkToCrud('Usuarios', 'fa fa-user', User::Class);
        yield MenuItem::linkToCrud('Departamento', 'fa fa-user', Departamento::Class);
        yield MenuItem::linkToCrud('Municipio', 'fa fa-user', Municipio::Class);
        yield MenuItem::linkToCrud('Categoria', 'fa fa-user', Categoria::Class);
        yield MenuItem::linkToCrud('Estados Pedido', 'fa fa-user', EstadoPedido::Class);
        yield MenuItem::linkToCrud('Tipo Movimiento', 'fa fa-user', TipoMovimiento::Class);
        yield MenuItem::linkToCrud('Tipo Vehiculo', 'fa fa-user', TipoVehiculo::Class);
        yield MenuItem::linkToCrud('Vehiculo', 'fa fa-user', Vehiculo::Class);
        yield MenuItem::linkToCrud('Bodega', 'fa fa-user', Bodega::Class);
        yield MenuItem::linkToCrud('Cliente', 'fa fa-user', Cliente::Class);
        yield MenuItem::linkToCrud('Producto', 'fa fa-user', Producto::Class);
        yield MenuItem::linkToCrud('Stock', 'fa fa-user', Stock::Class);
    }
}
