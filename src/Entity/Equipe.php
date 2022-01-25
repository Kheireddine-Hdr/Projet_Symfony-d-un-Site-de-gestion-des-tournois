<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="equipes")
     */
    private $equipeClub;

    /**
     * @ORM\OneToMany(targetEntity=Joueur::class, mappedBy="joueurEquipe")
     */
    private $joueurs;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="equipes")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=MatchJouer::class, mappedBy="equipe01")
     */
    private $MatchsJouers01;

    /**
     * @ORM\OneToMany(targetEntity=MatchJouer::class, mappedBy="equipe02")
     */
    private $MatchsJouer02;

    /**
     * @ORM\ManyToMany(targetEntity=Tours::class, mappedBy="equipes")
     */
    private $tours;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->MatchsJouers01 = new ArrayCollection();
        $this->MatchsJouer02 = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEquipeClub(): ?Club
    {
        return $this->equipeClub;
    }

    public function setEquipeClub(?Club $equipeClub): self
    {
        $this->equipeClub = $equipeClub;

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setJoueurEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getJoueurEquipe() === $this) {
                $joueur->setJoueurEquipe(null);
            }
        }

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * @return Collection|MatchJouer[]
     */
    public function getMatchsJouers01(): Collection
    {
        return $this->MatchsJouers01;
    }

    public function addMatchsJouers01(MatchJouer $matchsJouers01): self
    {
        if (!$this->MatchsJouers01->contains($matchsJouers01)) {
            $this->MatchsJouers01[] = $matchsJouers01;
            $matchsJouers01->setEquipe01($this);
        }

        return $this;
    }

    public function removeMatchsJouers01(MatchJouer $matchsJouers01): self
    {
        if ($this->MatchsJouers01->removeElement($matchsJouers01)) {
            // set the owning side to null (unless already changed)
            if ($matchsJouers01->getEquipe01() === $this) {
                $matchsJouers01->setEquipe01(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MatchJouer[]
     */
    public function getMatchsJouer02(): Collection
    {
        return $this->MatchsJouer02;
    }

    public function addMatchsJouer02(MatchJouer $matchsJouer02): self
    {
        if (!$this->MatchsJouer02->contains($matchsJouer02)) {
            $this->MatchsJouer02[] = $matchsJouer02;
            $matchsJouer02->setEquipe02($this);
        }

        return $this;
    }

    public function removeMatchsJouer02(MatchJouer $matchsJouer02): self
    {
        if ($this->MatchsJouer02->removeElement($matchsJouer02)) {
            // set the owning side to null (unless already changed)
            if ($matchsJouer02->getEquipe02() === $this) {
                $matchsJouer02->setEquipe02(null);
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
            $tour->addEquipe($this);
        }

        return $this;
    }

    public function removeTour(Tours $tour): self
    {
        if ($this->tours->removeElement($tour)) {
            $tour->removeEquipe($this);
        }

        return $this;
    }

}
