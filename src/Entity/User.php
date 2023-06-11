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

    #[ORM\Column(length: 1500, nullable: true)]
    private ?string $linkLinkedin = null;

    #[ORM\Column(length: 1500, nullable: true)]
    private ?string $linkSlack = null;

    #[ORM\Column(nullable: true)]
    private ?int $evalClientDev = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $objectifMensuelCommercial = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: SoftSkills::class, orphanRemoval: true)]
    private Collection $softSkills;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: IndicateurTech::class, orphanRemoval: true)]
    private Collection $indicateurTechs;

    #[ORM\OneToMany(mappedBy: 'consultant', targetEntity: Mission::class)]
    private Collection $missionsDev;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;
    private ?string $imgUrl = null;

    public function __construct()
    {
        $this->testResults = new ArrayCollection();
        $this->softSkills = new ArrayCollection();
        $this->indicateurTechs = new ArrayCollection();
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());
        $this->missionsDev = new ArrayCollection();

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
        // $roles[] = 'ROLE_USER';

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

    public function getLinkLinkedin(): ?string
    {
        return $this->linkLinkedin;
    }

    public function setLinkLinkedin(?string $linkLinkedin): self
    {
        $this->linkLinkedin = $linkLinkedin;

        return $this;
    }

    public function getLinkSlack(): ?string
    {
        return $this->linkSlack;
    }

    public function setLinkSlack(?string $linkSlack): self
    {
        $this->linkSlack = $linkSlack;

        return $this;
    }

    public function getEvalClientDev(): ?int
    {
        return $this->evalClientDev;
    }

    public function setEvalClientDev(?int $evalClientDev): self
    {
        $this->evalClientDev = $evalClientDev;

        return $this;
    }

    public function getObjectifMensuelCommercial(): ?string
    {
        return $this->objectifMensuelCommercial;
    }

    public function setObjectifMensuelCommercial(?string $objectifMensuelCommercial): self
    {
        $this->objectifMensuelCommercial = $objectifMensuelCommercial;

        return $this;
    }

    /**
     * @return Collection<int, SoftSkills>
     */
    public function getSoftSkills(): Collection
    {
        return $this->softSkills;
    }

    public function addSoftSkill(SoftSkills $softSkill): self
    {
        if (!$this->softSkills->contains($softSkill)) {
            $this->softSkills->add($softSkill);
            $softSkill->setIdUser($this);
        }

        return $this;
    }

    public function removeSoftSkill(SoftSkills $softSkill): self
    {
        if ($this->softSkills->removeElement($softSkill)) {
            // set the owning side to null (unless already changed)
            if ($softSkill->getIdUser() === $this) {
                $softSkill->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, IndicateurTech>
     */
    public function getIndicateurTechs(): Collection
    {
        return $this->indicateurTechs;
    }

    public function addIndicateurTech(IndicateurTech $indicateurTech): self
    {
        if (!$this->indicateurTechs->contains($indicateurTech)) {
            $this->indicateurTechs->add($indicateurTech);
            $indicateurTech->setIdUser($this);
        }

        return $this;
    }

    public function removeIndicateurTech(IndicateurTech $indicateurTech): self
    {
        if ($this->indicateurTechs->removeElement($indicateurTech)) {
            // set the owning side to null (unless already changed)
            if ($indicateurTech->getIdUser() === $this) {
                $indicateurTech->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissionsDev(): Collection
    {
        return $this->missionsDev;
    }

    public function addMissionsDev(Mission $missionsDev): self
    {
        if (!$this->missionsDev->contains($missionsDev)) {
            $this->missionsDev->add($missionsDev);
            $missionsDev->setConsultant($this);
        }

        return $this;
    }

    public function removeMissionsDev(Mission $missionsDev): self
    {
        if ($this->missionsDev->removeElement($missionsDev)) {
            // set the owning side to null (unless already changed)
            if ($missionsDev->getConsultant() === $this) {
                $missionsDev->setConsultant(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
    $this->avatar = $avatar;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(?string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }
}
