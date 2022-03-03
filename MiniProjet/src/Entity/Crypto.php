<?php

namespace App\Entity;

use App\Repository\CryptoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CryptoRepository::class)
 */
class Crypto
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
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCrea;

    /**
     * @ORM\Column(type="integer")
     */
    private $equiUSD;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $algo;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteEmise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qteMax;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="Crypto")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="Crypto", orphanRemoval=true)
     */
    private $commentaire;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCrea(): ?\DateTimeInterface
    {
        return $this->dateCrea;
    }

    public function setDateCrea(\DateTimeInterface $dateCrea): self
    {
        $this->dateCrea = $dateCrea;

        return $this;
    }

    public function getEquiUSD(): ?int
    {
        return $this->equiUSD;
    }

    public function setEquiUSD(int $equiUSD): self
    {
        $this->equiUSD = $equiUSD;

        return $this;
    }

    public function getAlgo(): ?string
    {
        return $this->algo;
    }

    public function setAlgo(string $algo): self
    {
        $this->algo = $algo;

        return $this;
    }

    public function getQteEmise(): ?int
    {
        return $this->qteEmise;
    }

    public function setQteEmise(int $qteEmise): self
    {
        $this->qteEmise = $qteEmise;

        return $this;
    }

    public function getQteMax(): ?string
    {
        return $this->qteMax;
    }

    public function setQteMax(string $qteMax): self
    {
        $this->qteMax = $qteMax;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCrypto($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCrypto($this);
        }

        return $this;
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
            $commentaire->setCrypto($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getCrypto() === $this) {
                $commentaire->setCrypto(null);
            }
        }

        return $this;
    }
}
