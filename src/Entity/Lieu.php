<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
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
    private $nom_lieu;

    /**
     * @ORM\Column (type="string", length=30,nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column (type="float",nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column (type="float",nullable=true)
     */
    private $longitude;


     /**
      * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="lieu")
      */
    private $ville;

    /**
     * @ORM\ManyToMany(targetEntity=Evenement::class, mappedBy="lieux")
     */
    private $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }




    //Générer les getters et setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomLieu()
    {
        return $this->nom_lieu;
    }

    /**
     * @param mixed $nom_lieu
     */
    public function setNomLieu($nom_lieu): void
    {
        $this->nom_lieu = $nom_lieu;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
    * @return mixed
     */
    public function getVille()
    {
    return $this->ville;
    }


    /**
    * @param mixed $ville
    */
    public function setVille($ville): void
    {
    $this->ville = $ville;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->addLieux($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            $evenement->removeLieux($this);
        }

        return $this;
    }




}
