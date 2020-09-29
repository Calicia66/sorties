<?php

namespace App\Controller;

use App\Entity\Campus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $campus = $campusRepo->findAll();
        return $this->render("campus/campus.html.twig", ["campus" => $campus]);
    }

    /**
     * @Route("/site/{id}", name="campus_site")
     */
    public function OneCampus($id)
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $campusRepo->find($id);
        return $this->render("campus/campus.html.twig", ["campus" => $campus]);
    }



    /**
     * @Route("/edit/{id},{libelle}", name="campus_edit")
     *
    */
    public function editor(Campus $id, String $libelle, EntityManagerInterface $em)
    {
        //On récupère l'instance de l'id fourni par Campus pour modification
        $campus = $id;
        $campus->setLibelle($libelle);

        if (!is_null($libelle) && !is_null($id)) {
            $em->persist($campus);
            $em->flush();

            //Afficher un message flash
            $this->addFlash('success', 'Votre campus a bien été modifié');


            //Redirige l utilisateur sur la page detail
            return $this->redirectToRoute('campus', [
            ]);

        }

        return $this->render("campus/campus_edit.html.twig", ["campus" => $campus]);



    }

}
