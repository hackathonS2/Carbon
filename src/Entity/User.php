<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeNaissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mailVerifyToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $mailVerifyTokenExp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $salaireSouhaite = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $evalClient = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: TestResults::class, orphanRemoval: true)]
    private Collection $testResults;

    public function __construct()
    {
        $this->testResults = new ArrayCollection();
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getMailVerifyToken(): ?string
    {
        return $this->mailVerifyToken;
    }

    public function setMailVerifyToken(?string $mailVerifyToken): self
    {
        $this->mailVerifyToken = $mailVerifyToken;

        return $this;
    }

    public function getMailVerifyTokenExp(): ?\DateTimeInterface
    {
        return $this->mailVerifyTokenExp;
    }

    public function setMailVerifyTokenExp(?\DateTimeInterface $mailVerifyTokenExp): self
    {
        $this->mailVerifyTokenExp = $mailVerifyTokenExp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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

    public function getSalaireSouhaite(): ?int
    {
        return $this->salaireSouhaite;
    }

    public function setSalaireSouhaite(?int $salaireSouhaite): self
    {
        $this->salaireSouhaite = $salaireSouhaite;

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

    public function getEvalClient(): ?int
    {
        return $this->evalClient;
    }

    public function setEvalClient(?int $evalClient): self
    {
        $this->evalClient = $evalClient;

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
            $testResult->setIdUser($this);
        }

        return $this;
    }

    public function removeTestResult(TestResults $testResult): self
    {
        if ($this->testResults->removeElement($testResult)) {
            // set the owning side to null (unless already changed)
            if ($testResult->getIdUser() === $this) {
                $testResult->setIdUser(null);
            }
        }

        return $this;
    }
}
