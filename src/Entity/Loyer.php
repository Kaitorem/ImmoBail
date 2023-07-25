<?php

namespace App\Entity;

use App\Repository\LoyerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoyerRepository::class)
 */
class Loyer
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
    private $mois;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat = false;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="loyers")
     */
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEtat(): bool
    {
        return $this->etat;
    }

    /**
     * @param bool $etat
     */
    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;
        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }
}
