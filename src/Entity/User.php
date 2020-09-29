<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="Users_app")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    public function __construct()
    {
        $this->evenements = new ArrayCollection();

    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $username;
    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $prenom;
    /**
     * @ORM\Column (type="string", length=15)
     */
    private $telephone;
    /**
     * @ORM\Column (type="string", length=20)
     */
    private $email;
    /**
     * @ORM\Column (type="string", length=255)
     */
    private $password;
    /**
     * @ORM\Column (type="boolean")
     */
    private $administrateur;
    /**
     * @ORM\Column (type="boolean")
     */
    private $actif;
    /**
     * @ORM\Column (type="datetime")
     */
    private $dateCreation;

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="User")
     *
     */
    private $campus;



//pas sauvegardé dans la base
    private $roles;

    /**
     * @ORM\ManyToMany (targetEntity="App\Entity\Evenement", inversedBy="users")
     */
    private $evenements;





    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telphone
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * @param mixed $administrateur
     * @return User
     */
    public function setAdministrateur($administrateur)
    {
        $this->administrateur = $administrateur;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     * @return User
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }
    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     * @return User
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
        return $this;
    }
    /**
     * @return mixed
     */

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }



    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
            $evenement->addUser($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->contains($evenement)) {
            $this->evenements->removeElement($evenement);
            $evenement->removeUser($this);
        }

        return $this;
    }
}
