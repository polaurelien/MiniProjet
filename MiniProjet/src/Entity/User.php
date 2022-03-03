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
class User
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
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity=Crypto::class, inversedBy="users")
     */
    private $Crypto;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Auteur", orphanRemoval=true)
     */
    private $commentaire;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
}
