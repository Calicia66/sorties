<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Evenement;
use App\Entity\Lieu;
use App\Entity\Ville;
use App\Form\CampusType;
use App\Form\EventType;
use App\Form\LieuType;

use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/evenement", )
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/list", name="evenement_list")
     */
    //méthode list qui permet d'afficher sur une page la liste des évènements enregistrés en BDD
    public function list(EntityManagerInterface $em)
    {
        //récupérer les sorties en base de donnée
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $event = $eventRepo->findAll();
        //Permet d'aller récupérer les campus
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus =$campusRepo->findAll();

        return $this->render('evenement/list.html.twig', [
            "events"=>$event, "campus"=>$campus
        ]);
    }

    /**
     * @Route("/detail/{id}", name="evenement_detail", requirements={"id": "\d+"})
     */
    //méthode detail qui permet d'afficher sur une page un évènement particulier enregistré en BDD
    public function detail($id)
    {
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        $event = $eventRepo->findByEvent($id);

        return $this->render('evenement/detail.html.twig', [
            "event"=>$event
        ]);
    }

    /**
     * @Route("/edit/{id}", name="evenement_edit", requirements={"id": "\d+"})
     */
    //méthode detail qui permet d'afficher sur une page un évènement particulier enregistré en BDD
    public function edit_detail($id)
    {
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        $event = $eventRepo->findByEvent($id);

        return $this->render('evenement/switch.html.twig', [
            "events"=>$event
        ]);
    }

    /**
     * @Route("/add", name="evenement_add")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function add(EntityManagerInterface $em, Request $request)
    {
        // Creer une instance de mon entity
        $event = new Evenement();
        $lieu = new Lieu();

        //Creer mon formulaire
        $eventform = $this->createForm(EventType::class, $event);
        $lieuform = $this->createForm(LieuType::class, $lieu);

        //Alimenter avec les données fournis dans le formulaire
        $eventform->handleRequest($request);
        $lieuform->handleRequest($request);

        //Champs cachés
       //  $event->getOrganisateur();
         // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($eventform->isSubmitted()&& $eventform->isValid()){
            $em->persist($event);
            $em->persist($lieu);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success','Votre evenement a bien été enregistré');


            //Redirige l utilisateur sur la page detail
            return  $this->redirectToRoute('evenement_detail',[
                'id'=>$event->getId()
            ]);
        }


        return $this->render('evenement/add.html.twig', [
            "eventform"=> $eventform->createView(),
            "lieuform"=> $lieuform->createView()

        ]);
    }

    /**
     * @Route("/evenement/cancel", name="evenement_cancel")
     */
    //méthode cancel qui permet d annuler une sortie
    public function cancel(EntityManagerInterface $em)
    {
        //récupérer les sorties en base de donnée
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $event = $eventRepo->findAll();


        return $this->render('evenement/cancel.html.twig', [
            "events"=>$event
        ]);
    }


    /**
     * @Route("/evenement/ville", name="evenement_ville")
     */
    //méthode ville qui permet de gerer des villes
    public function ville(EntityManagerInterface $em)
    {
        //récupérer les villes en base de donnée
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $event = $eventRepo->findAll();


        return $this->render('evenement/ville.html.twig', [
            "events"=>$event
        ]);
    }
    //Création du formulaire Lieu

    /**
     * @Route("/add_lieu", name="add_lieu")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function add_lieu(EntityManagerInterface $em, Request $request)
    {
        // Creer une instance de mon entity
        $lieu = new Lieu();
        $ville = new Ville();
        $campus =new campus();

        //Creer mon formulaire
        $lieuform = $this->createForm(LieuType::class, $lieu);
        $villeform = $this->createForm(VilleType::class, $ville);
        $campusform = $this->createForm(CampusType::class, $campus);
        //Alimenter avec les données fournis dans le formulaire
        $lieuform->handleRequest($request);
        $villeform->handleRequest($request);
        $campusform->handleRequest($request);
        //Champs cachés
        // $event->getOrganisateur();
        // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($lieuform->isSubmitted()&& $lieuform->isValid()){
            $em->persist($lieu);
            $em->persist($ville);
            $em->persist($campus);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success','Votre lieu a bien été enregistré');


            //Redirige l utilisateur sur la page detail
            return  $this->redirectToRoute('evenement_list',[
                'id'=>$lieu->getId()
            ]);
        }


        return $this->render('evenement/add_lieu.html.twig', [
            "lieuform"=> $lieuform->createView(),
            "villeform"=> $villeform->createView(),
            "campusform"=> $campusform->createView()
        ]);
    }



}
