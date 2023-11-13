<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'account')]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $uid;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $mailperso = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $datenais = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $diplomePrepare = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $derniereDiplome = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $derniereFiliere = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $adresseFixe = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $adresseActu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pratiqueArt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $otherComments = null;

    #[ORM\Column(nullable: true)]
    private $isVerified = 'true';

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $derniereFiliereHors = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $echangeInter = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAtU = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codEtu = null;


    public function __construct()
    {
        $this->setcreatedAtU(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->uid;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->uid;
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
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMailperso(): ?string
    {
        return $this->mailperso;
    }

    public function setMailperso(?string $mailperso): self
    {
        $this->mailperso = $mailperso;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

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

    public function getDatenais(): ?string
    {
        return $this->datenais;
    }

    public function setDatenais(?string $datenais): self
    {
        $this->datenais = $datenais;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDiplomePrepare(): ?string
    {
        return $this->diplomePrepare;
    }

    public function setDiplomePrepare(?string $diplomePrepare): self
    {
        $this->diplomePrepare = $diplomePrepare;

        return $this;
    }

    public function getDerniereDiplome(): ?string
    {
        return $this->derniereDiplome;
    }

    public function setDerniereDiplome(?string $derniereDiplome): self
    {
        $this->derniereDiplome = $derniereDiplome;

        return $this;
    }

    public function getDerniereFiliere(): ?string
    {
        return $this->derniereFiliere;
    }

    public function setDerniereFiliere(?string $derniereFiliere): self
    {
        $this->derniereFiliere = $derniereFiliere;

        return $this;
    }

    public function getAdresseFixe(): ?string
    {
        return $this->adresseFixe;
    }

    public function setAdresseFixe(?string $adresseFixe): self
    {
        $this->adresseFixe = $adresseFixe;

        return $this;
    }

    public function getAdresseActu(): ?string
    {
        return $this->adresseActu;
    }

    public function setAdresseActu(?string $adresseActu): self
    {
        $this->adresseActu = $adresseActu;

        return $this;
    }

    public function getPratiqueArt(): ?string
    {
        return $this->pratiqueArt;
    }

    public function setPratiqueArt(?string $pratiqueArt): self
    {
        $this->pratiqueArt = $pratiqueArt;

        return $this;
    }

    public function getOtherComments(): ?string
    {
        return $this->otherComments;
    }

    public function setOtherComments(?string $otherComments): self
    {
        $this->otherComments = $otherComments;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(?bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getDerniereFiliereHors(): ?string
    {
        return $this->derniereFiliereHors;
    }

    public function setDerniereFiliereHors(?string $derniereFiliereHors): self
    {
        $this->derniereFiliereHors = $derniereFiliereHors;

        return $this;
    }

    public function getEchangeInter(): ?string
    {
        return $this->echangeInter;
    }

    public function setEchangeInter(?string $echangeInter): self
    {
        $this->echangeInter = $echangeInter;

        return $this;
    }

    public function getCreatedAtU(): ?\DateTimeInterface
    {
        return $this->createdAtU;
    }

    public function setCreatedAtU(?\DateTimeInterface $createdAtU): self
    {
        $this->createdAtU = $createdAtU;

        return $this;
    }

    public function getCodEtu(): ?string
    {
        return $this->codEtu;
    }

    public function setCodEtu(?string $codEtu): self
    {
        $this->codEtu = $codEtu;

        return $this;
    }


}
