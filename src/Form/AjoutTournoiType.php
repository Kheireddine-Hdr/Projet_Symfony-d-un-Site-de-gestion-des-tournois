<?php

namespace App\Form;
use App\Entity\Evenement;
use App\Entity\Tournoi;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutTournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ev', EntityType::class, [ // nom de l'attribut dans Tournoi
                'class' => Evenement::class, // quelles entités
                'choice_label' => 'nom', // label des options du select
                'label' => 'Événement', // label avant le select

            //     'query_builder' => function (EntityRepository $er) { //er = EvenementRepo.
            //     $qb=$er->createQueryBuilder('e'); // e = Evenement
            //         // return $qb->where('e.id <= 5'); // ok DQL
            //     return $qb->where('e.nom like:exp')->setParameter('exp','chal%'); //ok
            //   }
            //     , 'expanded' => true // <select> devient checkboxes
            ])
             
             ->add('nom', TextType::class)
             ->add('description', TextType::class);   
             //->add('sauver', SubmitType::class, [
               //  'label' => 'Créer le tournoi !'
            //])
    }

    public function configureOptions(OptionsResolver $resolver): void{
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
