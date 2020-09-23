<?php

namespace App\Form;
use App\Entity\Evenement;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder //permet de rajouter les champs de mon formulaire
            ->add('nom')
            ->add('datedebut')
            ->add('duree')
            ->add('datecloture')
            ->add('descriptioninfos')
            ->add('etatsortie')
            ->add('urlPhoto')
            ->add('organisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
