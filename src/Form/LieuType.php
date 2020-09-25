<?php

namespace App\Form;


use App\Entity\Lieu;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_lieu', TextType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Nom du lieu'])
            ->add('rue', TextType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Nom de la rue'])
            ->add('latitude', TextType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Entrez votre latitude'])
            ->add('longitude', TextType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Entrez votre longitude'])
            //Création du champ ville
            ->add('ville', EntityType::class, [ 'class' => Ville::class,
                'label' => 'nom_ville'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //Associer formulaire à la classe Lieu
        $resolver->setDefaults([
            'date_class'=>Lieu::class,
        ]);
    }

}
