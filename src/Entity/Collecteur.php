<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CollecteurRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CollecteurRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *       "groups"={"collecteur_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class)
 */
class Collecteur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"collecteur_read","collects_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Telephone;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"collecteur_read","collects_read"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Genre;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Agence;

    /**
     * @ORM\OneToMany(targetEntity=Collecte::class, mappedBy="collecteur")
     * @Groups({"collecteur_read"})
     */
    private $collecte;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"collecteur_read","collects_read"})
     */
    private $Status;

    public function __construct()
    {
        $this->collecte = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->Telephone;
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
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }

    public function setMatricule(?string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getAgence(): ?string
    {
        return $this->Agence;
    }

    public function setAgence(?string $Agence): self
    {
        $this->Agence = $Agence;

        return $this;
    }

    /**
     * @return Collection<int, Collecte>
     */
    public function getCollecte(): Collection
    {
        return $this->collecte;
    }

    public function addCollecte(Collecte $collecte): self
    {
        if (!$this->collecte->contains($collecte)) {
            $this->collecte[] = $collecte;
            $collecte->setCollecteur($this);
        }

        return $this;
    }

    public function removeCollecte(Collecte $collecte): self
    {
        if ($this->collecte->removeElement($collecte)) {
            // set the owning side to null (unless already changed)
            if ($collecte->getCollecteur() === $this) {
                $collecte->setCollecteur(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}