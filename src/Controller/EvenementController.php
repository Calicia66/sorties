<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Evenement;
use App\Entity\Lieu;
use App\Form\EventType;
use App\Form\LieuType;
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

        //permet  d aller recuperer les campus
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
     * @Route("/add", name="evenement_add")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function add(EntityManagerInterface $em, Request $request)
    {
        // Creer une instance de mon entity
        $event = new Evenement();

        //Creer mon formulaire
        $eventform = $this->createForm(EventType::class, $event);
        //Alimenter avec les données fournis dans le formulaire
        $eventform->handleRequest($request);

        //Champs cachés
       //  $event->getOrganisateur();
         // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($eventform->isSubmitted()&& $eventform->isValid()){
            $em->persist($event);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success','Votre evenement a bien été enregistré');


            //Redirige l utilisateur sur la page detail
            return  $this->redirectToRoute('evenement_detail',[
                'id'=>$event->getId()
            ]);
        }


        return $this->render('evenement/add.html.twig', [
            "eventform"=> $eventform->createView()
        ]);
    }
    /**
     * @Route("/evenement/switch", name="evenement_switch")
     */
    //méthode switch qui permet d'afficher sur une page de modifier les données
    public function switch(EntityManagerInterface $em)
    {
        //récupérer les sorties en base de donnée
        $eventRepo = $this->getDoctrine()->getRepository(Evenement::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $event = $eventRepo->findAll();


        return $this->render('evenement/switch.html.twig', [
            "events"=>$event
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

    //Création du formulaire Lieu

    /**
     * @Route("/evenement/add_lieu", name="add_lieu")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function add_lieu(EntityManagerInterface $em, Request $request)
    {
        // Creer une instance de mon entity
        $event = new Lieu();

        //Creer mon formulaire
        $eventform = $this->createForm(LieuType::class, $event);

        //Alimenter avec les données fournis dans le formulaire
        $eventform->handleRequest($request);

        //Champs cachés
        //  $event->getOrganisateur();
        // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($eventform->isSubmitted()&& $eventform->isValid()){
            $em->persist($event);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success','Votre lieu a bien été enregistré');


            //Redirige l utilisateur sur la page detail
            return  $this->redirectToRoute('evenement_list',[
                'id'=>$event->getId()
            ]);
        }


        return $this->render('evenement/add_lieu.html.twig', [
            "eventform"=> $eventform->createView()
        ]);
    }



}
