<?php

namespace App\Entity;

use App\Repository\ToursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ToursRepository::class)
 */
class Tours
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
     * @ORM\ManyToMany(targetEntity=Equipe::class, inversedBy="tours")
     */
    private $equipes;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="tours")
     */
    private $groupes;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="tournoiTours")
     */
    private $tourTournoi;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->groupes = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        $this->equipes->removeElement($equipe);

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupes->removeElement($groupe);

        return $this;
    }

    public function getTourTournoi(): ?Tournoi
    {
        return $this->tourTournoi;
    }

    public function setTourTournoi(?Tournoi $tourTournoi): self
    {
        $this->tourTournoi = $tourTournoi;

        return $this;
    }
}
