<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(EntityManagerInterface $em,
                             Request $request,
                             UserPasswordEncoderInterface $encoder)
    {
        $User = new User();
        //création de la date automatiquement
        $User->setDateCreation(new \DateTime());
        $registerForm =$this->createForm(RegisterType::class, $User);
       //on envoie le formulaire dans le request
        $registerForm ->handleRequest($request);
        //on verifie le formulaire avant de le soumettre
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            //on crée un message d'alert à afficher en cas de succès
            $this->addFlash("success", "Données ajoutées avec succès");
            //Date de création du profil
            $User->setDateCreation(new \DateTime());
            $User->setAdministrateur(0);
            $User->setActif(0);
            //on envoie les données à doctrine sur le repository
            $hasher = $encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($hasher);
            $em->persist($User);
            //on finalise l'insertion des données sur la base de donnée Mysql
            $em->flush();
            //on fait une redirection vers une page à la suite
            return $this->redirectToRoute('app_login');
            //Dans le cas où le formulaire n\'est pas bien renseignée on revient sur la page
        }
        //on crée la vue du formulaire avant d'envoyer
        return $this->render('user/register.html.twig',["registerForm"=>$registerForm->createView()]);
    }
    /**
     * Formulaire de modification des données de l'utilisateur
     * basé sur la fonction Register mais prenant comme entité un utilisateur existant
     * l'id est directement transformer en objet User avec un accès sur toutes les méthodes
     * et atttributs
     * @Route("/edit/{id}", name="user_edit")
     */
        public function edit(EntityManagerInterface $em, Request $request, User $User, UserPasswordEncoderInterface $encoder)
    {

        $editorForm =$this->createForm(RegisterType::class, $User);
       // $editorForm->get("campus");
        //on envoie le formulaire dans le request
        $editorForm ->handleRequest($request);
        //on verifie le formulaire avant de le soumettre
        if ($editorForm->isSubmitted() && $editorForm->isValid()) {
            //on crée un message d'alert à afficher en cas de succès
            $this->addFlash("success", "Données ajoutées avec succès");
            //Date de création du profil
            $User->setDateCreation(new \DateTime());

            //on envoie les données à doctrine sur le repository
            $hasher = $encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($hasher);
            $em->persist($User);
            //on finalise l'insertion des données sur la base de donnée Mysql
            $em->flush();
            //on fait une redirection vers une page à la suite
            return $this->redirectToRoute('evenement_list');
            //Dans le cas où le formulaire n\'est pas bien renseignée on revient sur la page
        }
        //on crée la vue du formulaire avant d'envoyer
        return $this->render('user/register.html.twig',["registerForm"=>$editorForm->createView()]);
    }
    //liste des participants

    /**
     * @Route("/list", name="user_list")
     */
    public function participants()
    {
        {
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $participants =$userRepo->findAll();
            return $this->render("user/users_list.html.twig", ["Users"=>$participants]);
        }

    }



    /**
     * Affiche la page par défaut du projet Bucket-list
     * @Route("/profil/{id}", name="user_profil"),
     *    methods={"GET"}
     *     )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profil($id)
    {
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $profil =$userRepo->find($id);
            return $this->render("user/profil.html.twig", ["profil"=>$profil]);


    }
    /**
     * Affiche la page profil d'un participant
     * @Route("/participant/{id}", name="user_participant"),
     *    methods={"GET"}
     *     )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function participant($id)
    {
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $profil =$userRepo->find($id);
        return $this->render("user/afficher_profil.html.twig", ["profil"=>$profil]);


    }


}
