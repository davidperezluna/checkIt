<?php

namespace App\Controller\Admin;

use App\Entity\Municipio;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class MunicipioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Municipio::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('nombre'),
            Field::new('codigo'),
            AssociationField::new('departamento'),
        ];
    }
    
}
