<?php

namespace App\Controller;

use App\Entity\Ville;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/lieu", name="lieu_")
 */
class LieuController extends AbstractController
{
    /**
     * @Route("/villes", name="villes")
     */
    public function ville_list()
    {
        $villeRepo = $this->getDoctrine()->getRepository(Ville::class);
        $villes =$villeRepo->findAll();
        return $this->render("lieu/villes.html.twig", ["villes"=>$villes]);
    }


}
