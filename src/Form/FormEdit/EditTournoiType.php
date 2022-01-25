<?php

namespace App\Form;

use App\Entity\Tournoi;
use App\Entity\Evenement;
use App\Form\EvenementType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditTournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('ev', EvenementType::class) // ICI
            ->add('ev', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' =>'nom'
            ])
            ->add('nom')
            ->add('description')
            ->add('valider', SubmitType::class )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
