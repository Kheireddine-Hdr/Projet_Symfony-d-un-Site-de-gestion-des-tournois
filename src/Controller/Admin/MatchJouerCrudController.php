<?php

namespace App\Controller\Admin;;

use App\Entity\MatchJouer;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MatchJouerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MatchJouer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
         
        yield AssociationField::new('MatchsDegroupe');
        yield AssociationField::new('equipe01');
        yield IntegerField::new('score01');
        yield AssociationField::new('equipe02');
        yield TextField::new('description');
    }
    
}
