<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* Certains champs sont en anglais
        * car FormBuilderInterface impose que ces champs portent des noms spécifiques
        */

        $builder
            //Création du champs pseudo
            ->add("userName", TextType::class, ['label'=>'Pseudo',
                'required'   => true,])
            //Création du champs nom
            ->add('lastName',TextType::class, ['label'=>'Nom',
                'required'   => true,])
            //Création du champs prénom
            ->add('firstName',TextType::class, ['label'=>'Prénom',
                'required'   => true,])
            //Création du champs télephone
            ->add('phoneNumber', NumberType::class, ['label'=>'Télephone',
                'required'   => true,])
            //Création du champs mot de pas avec double confirmation
            ->add('password',RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identifques.',
                'options' => ['attr' => ['class' => 'Champs de mot de passe']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe']])
            ->add('email',EmailType::class)


        ;
    }
// On lie ce formulaire à la class User
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
