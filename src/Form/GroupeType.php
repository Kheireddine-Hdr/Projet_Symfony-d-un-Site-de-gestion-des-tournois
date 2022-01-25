<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Tournoi;
use App\Form\TournoiType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('tournoi', EntityType::class, [
                   'class' => Tournoi::class,
                   'choice_label' =>'nom'
             ])
            ->add('nom', TextType::class)
            //->add('valider', SubmitType::class )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}
