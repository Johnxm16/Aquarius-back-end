<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CollecteRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=CollecteRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *       "groups"={"collects_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class,properties={"categories.Libelle","Month"})
 * @ApiFilter(DateFilter::class)
 */
class Collecte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"collects_read","categories_read","collecteur_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"collects_read","collecteur_read"})
     */
    private $detailAdresse;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="collectes")
     * @Groups({"collects_read"})
     */
    private $utilisateurs;

    /**
     * @ORM\Column(type="date_immutable")
     * @Groups({"collects_read","collecteur_read"})
     */
    private $createAt;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     * @Groups({"collects_read"})
     */
    private $accoutingAt;

    /**
     * @ORM\ManyToOne(targetEntity=AnnulerCollecte::class, inversedBy="collectes")
     */
    private $annulerCollecte;



    /**
     * @ORM\ManyToOne(targetEntity=Collecteur::class, inversedBy="collecte")
     * @Groups({"collects_read"})
     */
    private $collecteur;



    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Month;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     * @Groups({"collects_read"})
     */
    private $collectedAt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"collects_read"})
     */
    private $Statut;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"collects_read"})
     */
    private $Sac = [];

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"collects_read"})
     */
    private $Adresse;



    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDetailAdresse(): ?string
    {
        return $this->detailAdresse;
    }

    public function setDetailAdresse(?string $detailAdresse): self
    {
        $this->detailAdresse = $detailAdresse;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateur
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(?Utilisateur $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }


    public function getAccoutingAt(): ?\DateTimeImmutable
    {
        return $this->accoutingAt;
    }

    public function setAccoutingAt(?\DateTimeImmutable $accoutingAt): self
    {
        $this->accoutingAt = $accoutingAt;

        return $this;
    }

    public function getAnnulerCollecte(): ?AnnulerCollecte
    {
        return $this->annulerCollecte;
    }

    public function setAnnulerCollecte(?AnnulerCollecte $annulerCollecte): self
    {
        $this->annulerCollecte = $annulerCollecte;

        return $this;
    }



    public function getCollecteur(): ?Collecteur
    {
        return $this->collecteur;
    }

    public function setCollecteur(?Collecteur $collecteur): self
    {
        $this->collecteur = $collecteur;

        return $this;
    }



    public function getMonth(): ?int
    {
        return $this->Month;
    }

    public function setMonth(?int $Month): self
    {
        $this->Month = $Month;

        return $this;
    }

    public function getCollectedAt(): ?\DateTimeImmutable
    {
        return $this->collectedAt;
    }

    public function setCollectedAt(?\DateTimeImmutable $collectedAt): self
    {
        $this->collectedAt = $collectedAt;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(?string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getSac(): ?array
    {
        return $this->Sac;
    }

    public function setSac(?array $Sac): self
    {
        $this->Sac = $Sac;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }
}