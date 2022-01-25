<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
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
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="groupes")
     */
    private $tournoi;

    /**
     * @ORM\OneToMany(targetEntity=Equipe::class, mappedBy="groupe")
     */
    private $equipes;

    /**
     * @ORM\ManyToMany(targetEntity=Tours::class, mappedBy="groupes")
     */
    private $tours;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->tours = new ArrayCollection();
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

    public function __toString()
    {      
        return $this-> nom;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): self
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
            $equipe->setGroupe($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getGroupe() === $this) {
                $equipe->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tours[]
     */
    public function getTours(): Collection
    {
        return $this->tours;
    }

    public function addTour(Tours $tour): self
    {
        if (!$this->tours->contains($tour)) {
            $this->tours[] = $tour;
            $tour->addGroupe($this);
        }

        return $this;
    }

    public function removeTour(Tours $tour): self
    {
        if ($this->tours->removeElement($tour)) {
            $tour->removeGroupe($this);
        }

        return $this;
    }

}
