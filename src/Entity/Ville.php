<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    //Ajouter les champs avec les annotations de type

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom_ville;

    /**
     * @ORM\Column (type="string", length=10)
     */
    private $code_postal;


    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Lieu", mappedBy="ville")
     */
    private $lieu;





    //Générer les getters et setters
    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nom_ville
     */
    public function setNomVille($nom_ville): void
    {
        $this->nom_ville = $nom_ville;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }


    /**
     * @return mixed
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * @param mixed $evenement
     */
    public function setEvenement($evenement): void
    {
        $this->evenement = $evenement;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu): void
    {
        $this->lieu = $lieu;
    }





}
