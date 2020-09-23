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
            ->add('nom', TextType::class,[
                'label'=> 'Evenement\'s nom'
            ])

            //Creation du champ date de debut
            ->add('datedebut', DateType::class,array (
                'placeholder'=> array(
                    'day'=>'jour',
                    'month'=>'mois',
                    'year'=>'année',
                )
            ),
                [ 'label'=> "Date du Debut d'Inscription"
    ])

            //Creation du champ duree
            ->add('duree',NumberType::class,[
        'label'=> "Durée "
    ])
            //Creation du champ date de cloture
            ->add('datecloture',DateType::class,array (
                'placeholder'=> array(
                    'day'=>'jour',
                    'month'=>'mois',
                    'year'=>'année',
                )
            ),
                [ 'label'=> "Date du Debut d'Inscription"
            ])

            //Creation du champ etat de sortie
            ->add('etatsortie',ChoiceType::class, array(
                'choices'=> array(
                    'Inscription'=>'Voulez-vous vous inscrire?',
                    'En cours'=>'En cours de validation',
                    'Inscrit'=>'inscription Valider'

            ),
            ),
                [
                'label'=>"Etat de sortie"
            ])

            //Creation du champ urlphoto
            ->add('urlphoto',TextareaType::class, [
                'label'=>"Photo"
            ])

            //Creation du champ organisateur
            ->add('organisateur',TextType::class, [
                'label'=>"Organisateur"

            ])


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
