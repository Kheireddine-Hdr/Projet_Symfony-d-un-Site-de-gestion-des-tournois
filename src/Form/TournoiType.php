<?php // src/Form/TournoiType.php

namespace App\Form;

//use Symfony\Component\Form\OptionsResolver;
use App\Form\EvenementType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TournoiType extends AbstractType{

public function buildForm(FormBuilderInterface $builder, array $options):void{
        $builder
        ->add('ev', EvenementType::class) // ICI
        ->add('nom', EntityType::class)
        ->add('description', TextType::class)
        ->add('sauver', SubmitType::class, ['label' => 'Créer le tournoi !']);
    }

}
