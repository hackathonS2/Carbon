<?php

namespace App\Entity;

use App\Repository\TechnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnoRepository::class)]
class Techno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idTechno', targetEntity: Test::class)]
    private Collection $tests;

    #[ORM\OneToMany(mappedBy: 'idTechno', targetEntity: IndicateurTech::class, orphanRemoval: true)]
    private Collection $indicateurTeches;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->indicateurTeches = new ArrayCollection();
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

    /**
     * @return Collection<int, Test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests->add($test);
            $test->setIdTechno($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getIdTechno() === $this) {
                $test->setIdTechno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, IndicateurTech>
     */
    public function getIndicateurTeches(): Collection
    {
        return $this->indicateurTeches;
    }

    public function addIndicateurTech(IndicateurTech $indicateurTech): self
    {
        if (!$this->indicateurTeches->contains($indicateurTech)) {
            $this->indicateurTeches->add($indicateurTech);
            $indicateurTech->setIdTechno($this);
        }

        return $this;
    }

    public function removeIndicateurTech(IndicateurTech $indicateurTech): self
    {
        if ($this->indicateurTeches->removeElement($indicateurTech)) {
            // set the owning side to null (unless already changed)
            if ($indicateurTech->getIdTechno() === $this) {
                $indicateurTech->setIdTechno(null);
            }
        }

        return $this;
    }
}
