<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $datedebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="date")
     */
    private $datecloture;


    /**
     * @ORM\Column (type="text")
     */
    private $descriptioninfos;

    /**
     * @ORM\Column (type="text", nullable=true)
     */
    private $etatsortie;

    /**
     * @ORM\Column (type="string", nullable=true)
     */
    private $urlPhoto;


    /**
    * Un événement est organisé par un-(e) et un-(e) seul-(e) utilisateur-(trice)
    * @ORM\Column (type="string", nullable=true)
    */
    private $organisateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $places;

    /**
     * Un événement possede un(e) ou plusieurs participant-(e)-(s) (utilisateur-(trice)-(s))
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="evenements")
     */
    private $users;


    //cascade={persist}
    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class, inversedBy="evenements")
     */
    private $lieux;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->lieux = new ArrayCollection();
    }


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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut): void
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDatecloture()
    {
        return $this->datecloture;
    }

    /**
     * @param mixed $datecloture
     */
    public function setDatecloture($datecloture): void
    {
        $this->datecloture = $datecloture;
    }

    /**
     * @return mixed
     */
    public function getDescriptioninfos()
    {
        return $this->descriptioninfos;
    }

    /**
     * @param mixed $descriptioninfos
     */
    public function setDescriptioninfos($descriptioninfos): void
    {
        $this->descriptioninfos = $descriptioninfos;
    }

    /**
     * @return mixed
     */
    public function getEtatsortie()
    {
        return $this->etatsortie;
    }

    /**
     * @param mixed $etatsortie
     */
    public function setEtatsortie($etatsortie): void
    {
        $this->etatsortie = $etatsortie;
    }

    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * @param mixed $urlPhoto
     */
    public function setUrlPhoto($urlPhoto): void
    {
        $this->urlPhoto = $urlPhoto;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
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

    /**
     * @return mixed
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @param mixed $places
     */
    public function setPlaces($places): void
    {
        $this->places = $places;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux[] = $lieux;
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): self
    {
        if ($this->lieux->contains($lieux)) {
            $this->lieux->removeElement($lieux);
        }

        return $this;
    }









}
