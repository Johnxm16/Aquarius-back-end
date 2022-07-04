<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  normalizationContext={
 *     "groups"={"adress_read"}
 *}
 *)
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"adress_read","collects_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"adress_read","collects_read"})
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity=Collecte::class, mappedBy="adresse")
     * @Groups({"adress_read"})
     */
    private $Collects;

    public function __construct()
    {
        $this->Collects = new ArrayCollection();
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
     * @return Collection<int, Collecte>
     */
    public function getCollects(): Collection
    {
        return $this->Collects;
    }

    public function addCollect(Collecte $collect): self
    {
        if (!$this->Collects->contains($collect)) {
            $this->Collects[] = $collect;
            $collect->setAdresse($this);
        }

        return $this;
    }

    public function removeCollect(Collecte $collect): self
    {
        if ($this->Collects->removeElement($collect)) {
            // set the owning side to null (unless already changed)
            if ($collect->getAdresse() === $this) {
                $collect->setAdresse(null);
            }
        }

        return $this;
    }
}