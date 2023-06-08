<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $difficulte = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Techno $idTechno = null;

    #[ORM\OneToMany(mappedBy: 'idTest', targetEntity: TestResults::class)]
    private Collection $testResults;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        if ($this->createdAt == null)
        {
            $this->createdAt = new \DateTimeImmutable();
        }
        $this->updatedAt = new \DateTimeImmutable();
        $this->testResults = new ArrayCollection();
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

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

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

    /**
     * @return Collection<int, TestResults>
     */
    public function getTestResults(): Collection
    {
        return $this->testResults;
    }

    public function addTestResult(TestResults $testResult): self
    {
        if (!$this->testResults->contains($testResult)) {
            $this->testResults->add($testResult);
            $testResult->setIdTest($this);
        }

        return $this;
    }

    public function removeTestResult(TestResults $testResult): self
    {
        if ($this->testResults->removeElement($testResult)) {
            // set the owning side to null (unless already changed)
            if ($testResult->getIdTest() === $this) {
                $testResult->setIdTest(null);
            }
        }

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
