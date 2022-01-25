<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JoueurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Joueur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            yield AssociationField::new('joueurEquipe');
            yield TextField::new('nom');
            yield TextField::new('prenom');
            yield TextField::new('niveau');
    }
}