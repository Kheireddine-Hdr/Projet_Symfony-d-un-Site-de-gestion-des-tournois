<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('ev', EntityType::class)//, [ // nom de l'attribut dans Tournoi
            // 'class' => Evenement::class, // quelles entités
            // 'choice_label' => 'nom', // label des options du select
            // 'label' => 'Événement', // label avant le select
            //'query_builder' => function (EntityRepository $er) { //er = EvenementRepo.
        //     $qb=$er->createQueryBuilder('e'); // e = Evenement 
        //     // return $qb->where('e.id <= 5'); // ok DQL

        //     return $qb->where('e.nom like:exp')

        //     ->setParameter('exp','chal%'); //ok
        // }
        //     , 'expanded' => true // <select> devient checkboxes
        //])
         
            ->add('nom')
            ->add('dateDebut')
            ->add('dateFin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
