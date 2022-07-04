<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 * normalizationContext={
 *       "groups"={"profile_read"}
 * }
 * @ApiFilter(SearchFilter::class,properties={"Utilisateur.nom":"exact"})
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profile_read","users_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"profile_read","users_read"})
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="profile")
     * @Groups({"profile_read"})
     */
    private $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setProfile($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getProfile() === $this) {
                $utilisateur->setProfile(null);
            }
        }

        return $this;
    }
}