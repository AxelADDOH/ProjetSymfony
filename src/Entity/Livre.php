<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre_livre;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_livre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_livre;

    /**
     * @ORM\Column(type="integer")
     */
    private $numISBN_livre;

    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="livres")
     */
    private $fk_auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Editeur::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_editeur;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="livre")
     */
    private $fk_categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="livres")
     */
    private $fk_client;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, inversedBy="livres")
     */
    private $fk_commande;

    public function __construct()
    {
        $this->fk_auteur = new ArrayCollection();
        $this->fk_categorie = new ArrayCollection();
        $this->fk_client = new ArrayCollection();
        $this->fk_commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreLivre(): ?string
    {
        return $this->titre_livre;
    }

    public function setTitreLivre(string $titre_livre): self
    {
        $this->titre_livre = $titre_livre;

        return $this;
    }

    public function getPrixLivre(): ?int
    {
        return $this->prix_livre;
    }

    public function setPrixLivre(int $prix_livre): self
    {
        $this->prix_livre = $prix_livre;

        return $this;
    }

    public function getImgLivre(): ?string
    {
        return $this->img_livre;
    }

    public function setImgLivre(string $img_livre): self
    {
        $this->img_livre = $img_livre;

        return $this;
    }

    public function getNumISBNLivre(): ?int
    {
        return $this->numISBN_livre;
    }

    public function setNumISBNLivre(int $numISBN_livre): self
    {
        $this->numISBN_livre = $numISBN_livre;

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getFkAuteur(): Collection
    {
        return $this->fk_auteur;
    }

    public function addFkAuteur(Auteur $fkAuteur): self
    {
        if (!$this->fk_auteur->contains($fkAuteur)) {
            $this->fk_auteur[] = $fkAuteur;
        }

        return $this;
    }

    public function removeFkAuteur(Auteur $fkAuteur): self
    {
        if ($this->fk_auteur->contains($fkAuteur)) {
            $this->fk_auteur->removeElement($fkAuteur);
        }

        return $this;
    }

    public function getFkEditeur(): ?Editeur
    {
        return $this->fk_editeur;
    }

    public function setFkEditeur(?Editeur $fk_editeur): self
    {
        $this->fk_editeur = $fk_editeur;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getFkCategorie(): Collection
    {
        return $this->fk_categorie;
    }

    public function addFkCategorie(Categorie $fkCategorie): self
    {
        if (!$this->fk_categorie->contains($fkCategorie)) {
            $this->fk_categorie[] = $fkCategorie;
            $fkCategorie->setLivre($this);
        }

        return $this;
    }

    public function removeFkCategorie(Categorie $fkCategorie): self
    {
        if ($this->fk_categorie->contains($fkCategorie)) {
            $this->fk_categorie->removeElement($fkCategorie);
            // set the owning side to null (unless already changed)
            if ($fkCategorie->getLivre() === $this) {
                $fkCategorie->setLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getFkClient(): Collection
    {
        return $this->fk_client;
    }

    public function addFkClient(Client $fkClient): self
    {
        if (!$this->fk_client->contains($fkClient)) {
            $this->fk_client[] = $fkClient;
        }

        return $this;
    }

    public function removeFkClient(Client $fkClient): self
    {
        if ($this->fk_client->contains($fkClient)) {
            $this->fk_client->removeElement($fkClient);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getFkCommande(): Collection
    {
        return $this->fk_commande;
    }

    public function addFkCommande(Commande $fkCommande): self
    {
        if (!$this->fk_commande->contains($fkCommande)) {
            $this->fk_commande[] = $fkCommande;
        }

        return $this;
    }

    public function removeFkCommande(Commande $fkCommande): self
    {
        if ($this->fk_commande->contains($fkCommande)) {
            $this->fk_commande->removeElement($fkCommande);
        }

        return $this;
    }
}
