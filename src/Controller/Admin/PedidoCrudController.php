<?php

namespace App\Controller\Admin;

use App\Entity\Pedido;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class PedidoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pedido::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('fechaInicial'), 
            Field::new('fechaEntrega'),
            AssociationField::new('vehiculo'),
            AssociationField::new('productosPedidos'),
        ];
    }
    
}
