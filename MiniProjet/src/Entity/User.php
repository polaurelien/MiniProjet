<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\ManyToMany(targetEntity=Crypto::class, inversedBy="users")
     */
    private $Crypto;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Auteur", orphanRemoval=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Roles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Salt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Username;

    public function __construct()
    {
        $this->Crypto = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


    /**
     * @return Collection<int, Crypto>
     */
    public function getCrypto(): Collection
    {
        return $this->Crypto;
    }

    public function addCrypto(Crypto $crypto): self
    {
        if (!$this->Crypto->contains($crypto)) {
            $this->Crypto[] = $crypto;
        }

        return $this;
    }

    public function removeCrypto(Crypto $crypto): self
    {
        $this->Crypto->removeElement($crypto);

        return $this;
    }

    // METHODES MANUELLES ----------------------------------------------------------------------------------------------

    /*
     *
     */
    public function setAdmin(): self
    {
        $this->role = "Admin";
        return $this;
    }

    public function setUser(): self
    {
        $this->role = "User";
        return $this;
    }

    public function isAdmin(): bool
    {
        return ($this->role == "Admin");
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setAuteur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAuteur() === $this) {
                $commentaire->setAuteur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Prenom;
    }


    public function getRoles()
    {
        return $this->role;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function getSalt()
    {
        return $this->Salt;
    }

    public function getUsername()
    {
        return $this->Username;
    }

    public function eraseCredentials()
    {

    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function setRoles(string $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }

    public function setSalt(?string $Salt): self
    {
        $this->Salt = $Salt;

        return $this;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }
}
