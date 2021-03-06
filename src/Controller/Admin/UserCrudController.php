<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\TipoIdentificacion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $roles = array(
            'Administrador' => "ROLE_ADMIN" ,
            'Usuario' => "ROLE_USER" , 
        );
        return [
            Field::new('id')->hideOnForm(),
            EmailField::new('email'),
            ChoiceField::new('roles')->setChoices($roles)->allowMultipleChoices(),
            Field::new('password')->setFormType(PasswordType::class)->setLabel("Contraseña")->hideOnIndex(),
            Field::new('nombres'),
            Field::new('apellidos'),
            Field::new('cedula'),
            Field::new('telefono'),
            AssociationField::new('tipoIdentificacion'),
        ];
    }
    

}
