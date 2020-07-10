<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRepository", repositoryClass=AuteurRepository::class)
 */
class Auteur
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
    private $nom_auteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_auteur;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, mappedBy="fk_auteur")
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

    public function getNomAuteur(): ?string
    {
        return $this->nom_auteur;
    }

    public function getSlug():string {
        return (new Slugify())->slugify($this->nom_auteur);
    }
    public function setNomAuteur(string $nom_auteur): self
    {
        $this->nom_auteur = $nom_auteur;

        return $this;
    }

    public function getPrenomAuteur(): ?string
    {
        return $this->prenom_auteur;
    }

    public function setPrenomAuteur(string $prenom_auteur): self
    {
        $this->prenom_auteur = $prenom_auteur;

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
            $livre->addFkAuteur($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            $livre->removeFkAuteur($this);
        }

        return $this;
    }
}
