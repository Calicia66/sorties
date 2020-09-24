<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
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
     * @ORM\Column (type="text",nullable=false)
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
     * @ORM\Column (type="string", nullable=true)
     */
    private $organisateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $places;
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
    }/**
 * @return mixed
 */
public function getPlaces()
{
    return $this->places;
}/**
 * @param mixed $places
 */
public function setPlaces($places): void
{
    $this->places = $places;
}




}
