<?php

namespace App\Entity;

use App\Repository\IndicateurTechRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndicateurTechRepository::class)]
class IndicateurTech
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $evaluationGlobalTech = null;

    #[ORM\ManyToOne(inversedBy: 'indicateurTechs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Techno $idTechno = null;

    #[ORM\ManyToOne(inversedBy: 'indicateurTechs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluationGlobalTech(): ?int
    {
        return $this->evaluationGlobalTech;
    }

    public function setEvaluationGlobalTech(?int $evaluationGlobalTech): self
    {
        $this->evaluationGlobalTech = $evaluationGlobalTech;

        return $this;
    }

    public function getIdTechno(): ?Techno
    {
        return $this->idTechno;
    }

    public function setIdTechno(?Techno $idTechno): self
    {
        $this->idTechno = $idTechno;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
