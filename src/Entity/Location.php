<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $amenagement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surfaceHabitable;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surfaceTerrain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombrePiece;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $classeEnergetique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixLoyer = 0.0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codePostale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived = false;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Loyer::class, mappedBy="location", cascade={"persist", "remove"})
     */
    private $loyers;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="location", cascade={"persist", "remove"})
     */
    private $documents;

    /**
     * @ORM\OneToOne(targetEntity=Locataire::class, inversedBy="location")
     */
    private $locataire;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    public function __construct()
    {
        $this->loyers = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAmenagement(): ?string
    {
        return $this->amenagement;
    }

    public function setAmenagement(?string $amenagement): self
    {
        $this->amenagement = $amenagement;

        return $this;
    }

    public function getSurfaceHabitable(): ?float
    {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable(?float $surfaceHabitable): self
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    public function getSurfaceTerrain(): ?float
    {
        return $this->surfaceTerrain;
    }

    public function setSurfaceTerrain(?float $surfaceTerrain): self
    {
        $this->surfaceTerrain = $surfaceTerrain;

        return $this;
    }

    public function getNombrePiece(): ?int
    {
        return $this->nombrePiece;
    }

    public function setNombrePiece(?int $nombrePiece): self
    {
        $this->nombrePiece = $nombrePiece;

        return $this;
    }

    public function getClasseEnergetique(): ?string
    {
        return $this->classeEnergetique;
    }

    public function setClasseEnergetique(?string $classeEnergetique): self
    {
        $this->classeEnergetique = $classeEnergetique;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixLoyer(): ?float
    {
        return $this->prixLoyer;
    }

    public function setPrixLoyer(?float $prixLoyer): self
    {
        $this->prixLoyer = $prixLoyer;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?int
    {
        return $this->codePostale;
    }

    public function setCodePostale(?int $codePostale): self
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Loyer[]
     */
    public function getLoyers(): Collection
    {
        return $this->loyers;
    }

    public function addLoyer(Loyer $loyer): self
    {
        if (!$this->loyers->contains($loyer)) {
            $this->loyers[] = $loyer;
            $loyer->setLocation($this);
        }

        return $this;
    }

    public function removeLoyer(Loyer $loyer): self
    {
        if ($this->loyers->removeElement($loyer)) {
            // set the owning side to null (unless already changed)
            if ($loyer->getLocation() === $this) {
                $loyer->setLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Image $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setLocation($this);
        }

        return $this;
    }

    public function removeDocument(Image $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getLocation() === $this) {
                $document->setLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocataire()
    {
        return $this->locataire;
    }

    /**
     * @param mixed $locataire
     */
    public function setLocataire($locataire): self
    {
        $this->locataire = $locataire;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
