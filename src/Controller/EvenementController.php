<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Evenement;
use App\Entity\Lieu;
use App\Entity\Ville;
use App\Form\EventType;
use App\Form\LieuType;
use App\Form\VilleType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
        $events = $eventRepo->findBy([],["organisateur"=>"ASC"],10);


        //Permet d'aller récupérer les campus
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $campusRepo->findAll();

        return $this->render('evenement/list.html.twig', [
            "events" => $events, "campus" => $campus,
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
            "event" => $event
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
            "events" => $event
        ]);
    }
    /**
     * @Route("/add", name="evenement_add")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function add(EntityManagerInterface $em, Request $request, UserInterface $user)
    {
        // Creer une instance de mon entity
        $event = new Evenement();
        //$lieu = new Lieu();
        //  On récupère le nom du campus de l'utilisateur courant
        //Creer mon formulaire
        $eventform = $this->createForm(EventType::class, $event);
       // $lieuform = $this->createForm(LieuType::class, $lieu);
        //  $campusform = $this->createForm(LieuType::class, $campus)
        //On fait appelle à l'utisateur courant en tant qu'organisateur
        $event->setOrganisateur($user->getUsername());
        //Alimenter avec les données fournis dans le formulaire
        $eventform->handleRequest($request);
        //$lieuform->handleRequest($request);
        // $campusform->handleRequest($request);
        //Champs cachés
        //  $event->getOrganisateur();
        // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($eventform->isSubmitted() && $eventform->isValid()) {
            $em->persist($event);
            //$em->persist($lieu);
            //  $em->persist($campus);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success', 'Votre evenement a bien été enregistré');


            //Redirige l utilisateur sur la page detail
            return $this->redirectToRoute('evenement_detail', [
                'id' => $event->getId()
            ]);
        }
        return $this->render('evenement/add.html.twig', [
            "eventform" => $eventform->createView(),


        ]);
    }
        /**
         * @Route("/edit/{id}", name="evenement_edit")
         */
        //méthode create qui permet d'afficher sur une page le formulaire
        //qui enregistre les données en BDD
    public function edit(EntityManagerInterface $em, Request $request, Evenement $id)
        {
            // Creer une instance de mon entity
            $event = $id;
            $lieu = $event->getLieux();
            //  On récupère le nom du campus de l'utilisateur courant
            //Creer mon formulaire
            $eventform = $this->createForm(EventType::class, $event);
            $lieuform = $this->createForm(LieuType::class, $lieu);
            //  $campusform = $this->createForm(LieuType::class, $campus);
            //Alimenter avec les données fournis dans le formulaire
            $eventform->handleRequest($request);
            $lieuform->handleRequest($request);
            // $campusform->handleRequest($request);
            //Champs cachés
            //  $event->getOrganisateur();
            // $event->setEtatsortie();


            //si formulaire valider alors  données sauvegarder
            if ($eventform->isSubmitted() && $eventform->isValid()) {
               // $em->persist($event);
               // $em->persist($lieu);
                //  $em->persist($campus);
                $em->flush();

                //Afficher un message flash
                $this->addFlash('success', 'Votre evenement a bien été enregistré');


                //Redirige l utilisateur sur la page detail
                return $this->redirectToRoute('evenement_detail', [
                    'id' => $event->getId()
                ]);
            }

            return $this->render('evenement/add.html.twig', [
                "eventform" => $eventform->createView(),
                "lieuform" => $lieuform->createView()

            ]);
        }
    /**
     * @Route("/suscribe/{event}", name="evenement_suscribe")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function suscribe(EntityManagerInterface $em, Request $request,
                             Evenement $event, UserInterface $user)
    {
        // Creer une instance de mon entity

        $event->addUser($user);
        $lieu = $event->getLieux();
        //  On récupère le nom du campus de l'utilisateur courant
        //Creer mon formulaire
        $eventform = $this->createForm(EventType::class, $event);
        $lieuform = $this->createForm(LieuType::class, $lieu);
        //  $campusform = $this->createForm(LieuType::class, $campus);
        //Alimenter avec les données fournis dans le formulaire


        // $campusform->handleRequest($request);
        //Champs cachés
        //  $event->getOrganisateur();
        // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if (!is_null($event) &&!is_null($user)) {
             $em->persist($event);

            $em->flush();

            //Afficher un message flash
            $this->addFlash('success', 'Votre participation a été ajoutée');


            //Redirige l utilisateur sur la page detail
            return $this->redirectToRoute('evenement_detail', [
                'id' => $event->getId()
            ]);
        }

        return $this->render('evenement_detail', [
            'id' => $event->getId()
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
            "events" => $event
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
            "events" => $event
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
        //$ville = new Ville();


        //Creer mon formulaire
        $lieuform = $this->createForm(LieuType::class, $lieu);
        //$villeform = $this->createForm(VilleType::class, $ville);

        //Alimenter avec les données fournis dans le formulaire
        $lieuform->handleRequest($request);
        //$villeform->handleRequest($request);

        //Champs cachés
        // $event->getOrganisateur();
        // $event->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($lieuform->isSubmitted()&& $lieuform->isValid()){
            $em->persist($lieu);
            //$em->persist($ville);
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

        ]);
    }



}
