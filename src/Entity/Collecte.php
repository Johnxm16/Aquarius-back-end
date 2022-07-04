<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CollecteRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=CollecteRepository::class)
 * @ApiResource(
 *  attributes={
 *      "pagination_enabled" = true,
 *      "pagination_items_per_page" = 10 
 *  },
 *  normalizationContext={
 *       "groups"={"collects_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class,properties={"categories.Libelle"})
 */
class Collecte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"collects_read","categories_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"collects_read","categories_read"})
     */
    private $detailAdresse;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="collectes")
     * @Groups({"collects_read","categories_read"})
     */
    private $utilisateurs;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"collects_read"})
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"collects_read"})
     */
    private $deleteDate;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"collects_read"})
     */
    private $accoutingAt;

    /**
     * @ORM\ManyToOne(targetEntity=AnnulerCollecte::class, inversedBy="collectes")
     */
    private $annulerCollecte;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="Collects")
     * @Groups({"collects_read"})
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Collecteur::class, inversedBy="collecte")
     * @Groups({"collects_read"})
     */
    private $collecteur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="collectes")
     * @Groups({"collects_read"})
     */
    private $categories;

   

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

    public function getDeleteDate(): ?\DateTimeInterface
    {
        return $this->deleteDate;
    }

    public function setDeleteDate(?\DateTimeInterface $deleteDate): self
    {
        $this->deleteDate = $deleteDate;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

}