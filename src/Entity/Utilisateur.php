<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *  normalizationContext={
 *       "groups"={"users_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class)
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users_read","collects_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"users_read","collects_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"users_read"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"users_read","collects_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"users_read","collects_read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"users_read","collects_read"})
     */
    private $genre;

    /**
     * @ORM\Column(type="bigint", unique=true)
     * @Groups({"users_read","collects_read"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"users_read"})
     */
    private $login;

    /**
     * @ORM\OneToMany(targetEntity=Collecte::class, mappedBy="utilisateurs")
     * @Groups({"users_read"})
     */
    private $collectes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"users_read","collects_read"})
     */
    private $Point;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"users_read"})
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class, inversedBy="utilisateurs")
     * @Groups({"users_read"})
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity=Grade::class, inversedBy="utilisateurs")
     * @Groups({"users_read"})
     */
    private $grade;
 

    public function __construct()
    {
        $this->collectes = new ArrayCollection();
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
    public function getUsername(): string
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
     * @see UserInterface
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return Collection<int, Collecte>
     */
    public function getCollectes(): Collection
    {
        return $this->collectes;
    }

    public function addCollecte(Collecte $collecte): self
    {
        if (!$this->collectes->contains($collecte)) {
            $this->collectes[] = $collecte;
            $collecte->setUtilisateurs($this);
        }

        return $this;
    }

    public function removeCollecte(Collecte $collecte): self
    {
        if ($this->collectes->removeElement($collecte)) {
            // set the owning side to null (unless already changed)
            if ($collecte->getUtilisateurs() === $this) {
                $collecte->setUtilisateurs(null);
            }
        }

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->Point;
    }

    public function setPoint(?int $Point): self
    {
        $this->Point = $Point;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(?Grade $grade): self
    {
        $this->grade = $grade;

        return $this;
    }
 
}