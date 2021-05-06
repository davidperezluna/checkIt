<?php

namespace App\Controller\Admin;

use App\Entity\Vehiculo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class VehiculoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehiculo::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('placa'),
            Field::new('modelo'),
            AssociationField::new('tipoVehiculo'),
            AssociationField::new('conductor'),
        ];
    }
    
}
