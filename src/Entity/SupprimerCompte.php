<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SupprimerCompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SupprimerCompteRepository::class)
 */
class SupprimerCompte
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, cascade={"persist", "remove"})
     */
    private $utilsateur;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getUtilsateur(): ?Utilisateur
    {
        return $this->utilsateur;
    }

    public function setUtilsateur(?Utilisateur $utilsateur): self
    {
        $this->utilsateur = $utilsateur;

        return $this;
    }
}
