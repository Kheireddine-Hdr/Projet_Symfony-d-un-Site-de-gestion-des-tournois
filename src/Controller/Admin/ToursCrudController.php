<?php

namespace App\Controller\Admin;

use App\Entity\Tours;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ToursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tours::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('tourTournoi');
        yield AssociationField::new('groupes');
        yield AssociationField::new('equipes');
        yield TextField::new('nom');
    }
    
}
