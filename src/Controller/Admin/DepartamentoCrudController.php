<?php

namespace App\Controller\Admin;

use App\Entity\Departamento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DepartamentoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Departamento::class;
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
