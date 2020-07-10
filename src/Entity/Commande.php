<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_commande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modePayement_Commande;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_commande_HT;

    /**
     * @ORM\Column(type="float")
     */
    private $cout_commande_TTC;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, mappedBy="fk_commande")
     */
    private $livres;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->date_commande = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getModePayementCommande(): ?string
    {
        return $this->modePayement_Commande;
    }

    public function setModePayementCommande(string $modePayement_Commande): self
    {
        $this->modePayement_Commande = $modePayement_Commande;

        return $this;
    }

    public function getPrixCommandeHT(): ?float
    {
        return $this->prix_commande_HT;
    }

    public function setPrixCommandeHT(float $prix_commande_HT): self
    {
        $this->prix_commande_HT = $prix_commande_HT;

        return $this;
    }

    public function getCoutCommandeTTC(): ?float
    {
        return $this->cout_commande_TTC;
    }

    public function setCoutCommandeTTC(float $cout_commande_TTC): self
    {
        $this->cout_commande_TTC = $cout_commande_TTC;

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
            $livre->addFkCommande($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            $livre->removeFkCommande($this);
        }

        return $this;
    }
}
