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
    public function campus()
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus =$campusRepo->findAll();
        return $this->render("campus/campus.html.twig", ["campus"=>$campus]);
    }
    /**
     * @Route("/list/{id}", name="campus_list")
     */
    public function campus_list($id)
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campus =$campusRepo->findAll();
        return $this->render("campus/campus_.html.twig", ["campus"=>$campus]);
    }
}
