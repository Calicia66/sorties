<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(EntityManagerInterface $em,
                             Request $request,
                             UserPasswordEncoderInterface $encoder)
    {
        $User = new User();
        //création de la date automatiquement
        $User->setDateCreation(new \DateTime());
        $registerForm =$this->createForm(RegisterType::class, $User);
        //$Bucketlist->setDateCreated(new \DateTime());
        $registerForm ->handleRequest($request);
        //on verifie le formulaire avant de le soumettre
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            //on crée un message d'alert à afficher en cas de succès
            $this->addFlash("success", "Données ajoutées avec succès");
            //dump($Bucketlist);
            //on envoie les données à doctrine sur le repository
            $hasher = $encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($hasher);
            $em->persist($User);
            //on finalise l'insertion des données sur la base de donnée Mysql
            $em->flush();
            //on fait une redirection vers une page à la suite
            return $this->redirectToRoute('user_register');
            //Dans le cas où le formulaire n\'est pas bien renseignée on revient sur la page
        }
        //on crée la vue du formulaire avant d'envoyer
        return $this->render('user/register.html.twig',["registerForm"=>$registerForm->createView()]);
    }
}
