<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\User;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class RegisterType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* Certains champs sont en anglais
        * car FormBuilderInterface impose que ces champs portent des noms spécifiques
        */
        $campus = new Campus();
        $builder
            //Création du champs pseudo
            ->add("username", TextType::class, ['label'=>'Login',
                'required'   => true,])
            //Création du champs nom
            ->add('nom',TextType::class, ['label'=>'Nom',
                'required'   => true,])
            //Création du champs prénom
            ->add('prenom',TextType::class, ['label'=>'Prénom',
                'required'   => true,])
            //Création du champs télephone
            ->add('telephone', NumberType::class, ['label'=>'Téléphone',
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
            //Affichage du contenu de l'entité campus sur le choix du labelle inscrit dans la bdd
            ->add('Campus', EntityType::class, [
                'class' => Campus::class,
                'choice_label' => 'libelle',])


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
