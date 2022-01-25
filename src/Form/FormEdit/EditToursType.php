<?php

namespace App\Form;

use App\Entity\Tours;
use App\Entity\Equipe;
use App\Entity\Groupe;
use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditToursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('tourTournoi', EntityType::class, [
            'class' => Tournoi::class,
            'choice_label' =>'nom'
        ])
        
        ->add('nom')
        ->add('groupes', EntityType::class, [
            'class' => Groupe::class,
            'choice_label' =>'nom',
            'multiple' => true
             

        ])
        ->add('equipes', EntityType::class, [
            'class' => Equipe::class,
            'choice_label' =>'nom',
            'multiple' => true,
            'expanded' => true

        ])
        ->add('valider', SubmitType::class )    
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tours::class,
        ]);
    }
}
