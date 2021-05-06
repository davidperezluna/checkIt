<?php

namespace App\Controller\Admin;

use App\Entity\Bodega;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class BodegaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bodega::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('nombre'),
            Field::new('direccion'),
            Field::new('telefono'),
            Field::new('email'),
            AssociationField::new('municipio')->autocomplete(),
            AssociationField::new('responzable'),
        ];
    }
    
}
