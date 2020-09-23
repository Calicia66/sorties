<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="evenement_list")
     */
    //méthode list qui permet d'afficher sur une page la liste des évènements enregistrés en BDD
    public function list()
    {
        //récupérer les sorties en base de donnée
        $sortieRepo = $this->getDoctrine()->getRepository(Evenement::class);
        //findAll permet de récupérer toute les sorties enregistrées.
        $sorties = $sortieRepo->findAll();


        return $this->render('evenement/list.html.twig', [
            "sorties"=>$sorties
        ]);
    }

    /**
     * @Route("/evenement/{id}", name="evenement_detail", requirements={"id": "\d+"})
     */
    //méthode detail qui permet d'afficher sur une page un évènement particulier enregistré en BDD
    public function detail($id)
    {
        //@todo : récupérer la série en BDDdie($id);

        return $this->render('evenement/add.html.twig', []);
    }

    /**
     * @Route("/evenement/add", name="evenement_add")
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

        //si formulaire valider alors  données sauvegarder
        if ($eventform->isSubmitted()){
            $em->persist($event);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success','Votre evenement a bien été enregistrer');


            //Redirige l utilisateur sur la page detail
            return  $this->redirectToRoute('evenement_detail',[
                'id'=>$event->getId()
            ]);
        }


        return $this->render('evenement/add.html.twig', [
            "eventform"=> $eventform->createView()
        ]);
    }
}
