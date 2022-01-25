<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MatchJouerRepository;

/**
 * @ORM\Entity(repositoryClass=MatchJouerRepository::class)
 */
class MatchJouer
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="MatchsJouers01")
     */
    private $equipe01;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score01;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="MatchsJouer02")
     */
    private $equipe02;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score02;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class)
     */
    private $MatchsDegroupe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipe01(): ?Equipe
    {
        return $this->equipe01;
    }

    public function setEquipe01(?Equipe $equipe01): self
    {
        $this->equipe01 = $equipe01;

        return $this;
    }

    public function getScore01(): ?int
    {
        return $this->score01;
    }

    public function setScore01(?int $score01): self
    {
        $this->score01 = $score01;

        return $this;
    }

    public function getEquipe02(): ?Equipe
    {
        return $this->equipe02;
    }

    public function setEquipe02(?Equipe $equipe02): self
    {
        $this->equipe02 = $equipe02;

        return $this;
    }

    public function getScore02(): ?int
    {
        return $this->score02;
    }

    public function setScore02(?int $score02): self
    {
        $this->score02 = $score02;

        return $this;
    }

    public function getMatchsDegroupe(): ?Groupe
    {
        return $this->MatchsDegroupe;
    }

    public function setMatchsDegroupe(?Groupe $MatchsDegroupe): self
    {
        $this->MatchsDegroupe = $MatchsDegroupe;

        return $this;
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

}
