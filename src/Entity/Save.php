<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SaveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SaveRepository::class)
 */
class Save
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NCBD;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateCollecte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNCBD(): ?int
    {
        return $this->NCBD;
    }

    public function setNCBD(?int $NCBD): self
    {
        $this->NCBD = $NCBD;

        return $this;
    }

    public function getDateCollecte(): ?\DateTimeInterface
    {
        return $this->DateCollecte;
    }

    public function setDateCollecte(?\DateTimeInterface $DateCollecte): self
    {
        $this->DateCollecte = $DateCollecte;

        return $this;
    }
}
