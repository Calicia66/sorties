<?php

namespace App\Form;

use http\Env\Url;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Evenement;
use Symfony\Component\Validator\Constraints\DateTime;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Ajoute les champs requis ainsi que les types
        //Pas Obligatoire mais on peut rajouter des options(label) ou/et des attributs (class)
        $builder

            //Creation du champ nom


        ->add('nom', Texttype::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Titre de l evenement'])

            ->add('descriptioninfos', TextareaType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Descriptif de l evenement'])


            //Creation du champ date de debut
          ->add('datedebut', DateType::class, [  'attr' => ['class' => 'form-control'],
              'placeholder' => [
                  'year' => 'Year',
                  'month' => 'Month',
                  'day' => 'Day',
              ],

                'label'=> "Date du Debut d'Inscription"
    ])

            //Creation du champ duree
            ->add('duree',NumberType::class,[  'attr' => ['class' => 'form-control'],
        'label'=> "Durée"
    ])
            //Creation du champ date de cloture

            ->add('datecloture', DateType::class, [  'attr' => ['class' => 'form-control'],
                'placeholder' => [
                    'year' => 'Year',
                    'month' => 'Month',
                    'day' => 'Day',
                ],

                'label'=> "Date de fin"
            ])
            ->add('descriptioninfos', TextareaType::class, [    'attr' => ['class' => 'form-control'],
                'label'=> 'Description de l evenement'])



            //Creation du champ urlphoto
          //->add('urlphoto',TexteType::class, [
            //    'label'=>"Photo"
            //])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //Associer formulaire à la classe Evenement
        $resolver->setDefaults([
            'date_class'=>Evenement::class,
        ]);
    }
}
