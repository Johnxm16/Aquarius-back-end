<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnulerCollecteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AnnulerCollecteRepository::class)
 */
class AnnulerCollecte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $raison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity=Collecte::class, mappedBy="annulerCollecte")
     */
    private $collectes;

    public function __construct()
    {
        $this->collectes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): self
    {
        $this->raison = $raison;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

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
            $collecte->setAnnulerCollecte($this);
        }

        return $this;
    }

    public function removeCollecte(Collecte $collecte): self
    {
        if ($this->collectes->removeElement($collecte)) {
            // set the owning side to null (unless already changed)
            if ($collecte->getAnnulerCollecte() === $this) {
                $collecte->setAnnulerCollecte(null);
            }
        }

        return $this;
    }
}
