<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"categories_read"}
 * }
 * )
 * @ApiFilter(SearchFilter::class)
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"categories_read","SousCat_read","collects_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"categories_read","SousCat_read","collects_read"})
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity=SousCategorie::class, mappedBy="categories")
     * @Groups({"categories_read"})
     */
    private $sousCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Collecte::class, inversedBy="categories")
     * @Groups({"categories_read"})
     */
    private $collectes;


    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
        $this->collectes = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, SousCategorie>
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategorie $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
            $sousCategory->setCategories($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategorie $sousCategory): self
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getCategories() === $this) {
                $sousCategory->setCategories(null);
            }
        }

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
        }

        return $this;
    }

    public function removeCollecte(Collecte $collecte): self
    {
        $this->collectes->removeElement($collecte);

        return $this;
    }
}