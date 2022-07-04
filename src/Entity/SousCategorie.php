<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\SousCategorieRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *  attributes={
 *      "pagination_enabled" =true
 *  },
 *  normalizationContext={
 *       "groups"={"SousCat_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class)
 * @ORM\Entity(repositoryClass=SousCategorieRepository::class)
 */
class SousCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"SousCat_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70,nullable=true)
     * @Groups({"SousCat_read"})
     */
    private $Libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="sousCategories")
     * @Groups({"SousCat_read"})
     */
    private $categories;

    /**
     * @ORM\Column(type="bigint",nullable=true)
     * @Groups({"SousCat_read"})
     */
    private $Quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

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

    public function getQuantite(): ?string
    {
        return $this->Quantite;
    }

    public function setQuantite(string $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }
}