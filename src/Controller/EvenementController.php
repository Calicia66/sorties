<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        dump($sorties);

        return $this->render('evenement/list.html.twig', []);
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
    public function create()
    {
        //@todo: traiter le formulaire
        return $this->render('evenement/add.html.twig');
    }
}
