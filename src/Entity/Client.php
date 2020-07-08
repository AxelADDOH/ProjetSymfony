<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone_client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_client;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, mappedBy="fk_client")
     */
    private $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(string $prenom_client): self
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getAdresseClient(): ?string
    {
        return $this->adresse_client;
    }

    public function setAdresseClient(string $adresse_client): self
    {
        $this->adresse_client = $adresse_client;

        return $this;
    }

    public function getTelephoneClient(): ?string
    {
        return $this->telephone_client;
    }

    public function setTelephoneClient(string $telephone_client): self
    {
        $this->telephone_client = $telephone_client;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->email_client;
    }

    public function setEmailClient(string $email_client): self
    {
        $this->email_client = $email_client;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->addFkClient($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            $livre->removeFkClient($this);
        }

        return $this;
    }
}
