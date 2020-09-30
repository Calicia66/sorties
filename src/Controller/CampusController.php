<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Evenement;
use App\Form\CampusType;
use App\Form\EventType;
use App\Form\LieuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/campus")
 */
class CampusController extends AbstractController
{
    /**
     * @Route("/", name="campus")
     */
    public function campus_all()
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus =$campusRepo->findAll();
        return $this->render("campus/campus.html.twig", ["campus"=>$campus]);
    }
    /**
     * @Route("/site/{id}", name="campus_site")
     */
    public function OneCampus($id)
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus =$campusRepo->find($id);
        return $this->render("campus/campus.html.twig", ["campus"=>$campus]);
    }

    /**
     * @Route("/edit/{id}", name="campus_edit")
     */
    //méthode create qui permet d'afficher sur une page le formulaire
    //qui enregistre les données en BDD
    public function edit(EntityManagerInterface $em, Request $request, Campus $id)
    {
        //  On récupère le nom du campus de l'utilisateur courant
        $campus = $id;

        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campusList =$campusRepo->findAll();
        //On recrée son formulaire
        $campusform = $this->createForm(CampusType::class, $campus);

        //On alimente avec les données fournis dans le formulaire
        $campusform->handleRequest($request);

        // $campusform->handleRequest($request);
        //Champs cachés
        //  $campus->getOrganisateur();
        // $campus->setEtatsortie();


        //si formulaire valider alors  données sauvegarder
        if ($campusform->isSubmitted() && $campusform->isValid()) {
            // $em->persist($campus);
            // $em->persist($lieu);
            //  $em->persist($campus);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success', 'Votre Campus a bien été enregistré');

            //Redirige l utilisateur sur la page detail
            return $this->redirectToRoute('campus', [
                'id' => $campus->getId()
            ]);
        }
        return $this->render('campus/campus_edit.html.twig', [
            "campusform" => $campusform->createView(),
            "campusList" => $campusList

        ]);
    }

}
