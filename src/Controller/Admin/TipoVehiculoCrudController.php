<?php

namespace App\Controller\Admin;

use App\Entity\TipoVehiculo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TipoVehiculoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TipoVehiculo::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
