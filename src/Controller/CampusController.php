<?php

namespace App\Controller;

use App\Entity\Campus;
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


}
