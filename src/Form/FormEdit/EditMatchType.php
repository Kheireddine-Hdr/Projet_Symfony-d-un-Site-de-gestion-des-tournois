<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Groupe;
use App\Entity\MatchJouer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('MatchsDegroupe', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' =>'nom'
            ])
            ->add('equipe01', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' =>'nom'
            ])
            ->add('score01')
            ->add('equipe02', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' =>'nom'
            ])
            ->add('score02')
            ->add('description') 
            ->add('valider', SubmitType::class ) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MatchJouer::class,
        ]);
    }
}
