<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipe::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('equipeClub');
        yield AssociationField::new('groupe');
        yield TextField::new('nom');
        yield TextField::new('description');
    }
    
}
