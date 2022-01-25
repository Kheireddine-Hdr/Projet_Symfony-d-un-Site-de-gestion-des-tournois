<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\TournoiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TournoiRepository::class)
 */
class Tournoi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class, inversedBy="tournois", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type(type="App\Entity\Evenement")
     * @Assert\Valid
     */
    private $ev;

    /**
     * @ORM\OneToMany(targetEntity=Equipe::class, mappedBy="equipeTournoi")
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="tournoi")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=Tours::class, mappedBy="tourTournoi")
     */
    private $tournoiTours;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->tournoiTours = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEv(): ?Evenement
    {
        return $this->ev;
    }

    public function setEv(?Evenement $ev): self
    {
        $this->ev = $ev;

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
            $equipe->setEquipeTournoi($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getEquipeTournoi() === $this) {
                $equipe->setEquipeTournoi(null);
            }
        }

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
            $groupe->setTournoi($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getTournoi() === $this) {
                $groupe->setTournoi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tours[]
     */
    public function getTournoiTours(): Collection
    {
        return $this->tournoiTours;
    }

    public function addTournoiTour(Tours $tournoiTour): self
    {
        if (!$this->tournoiTours->contains($tournoiTour)) {
            $this->tournoiTours[] = $tournoiTour;
            $tournoiTour->setTourTournoi($this);
        }

        return $this;
    }

    public function removeTournoiTour(Tours $tournoiTour): self
    {
        if ($this->tournoiTours->removeElement($tournoiTour)) {
            // set the owning side to null (unless already changed)
            if ($tournoiTour->getTourTournoi() === $this) {
                $tournoiTour->setTourTournoi(null);
            }
        }

        return $this;
    }
}
