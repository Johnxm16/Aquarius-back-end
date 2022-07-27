<?php

namespace App\Entity;

use App\Repository\ChartjsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ChartjsRepository::class)
 * @ApiResource()
 */
class Chartjs
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
    private $Month;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NCBM;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNCBM(): ?int
    {
        return $this->NCBM;
    }

    public function setNCBM(?int $NCBM): self
    {
        $this->NCBM = $NCBM;

        return $this;
    }
}
