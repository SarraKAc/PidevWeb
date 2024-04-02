<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ressource
 *
 * @ORM\Table(name="ressource", indexes={@ORM\Index(name="fk_user_id", columns={"utilisateur_id"}), @ORM\Index(name="Nom", columns={"Nom"}), @ORM\Index(name="categorie_nom", columns={"categorie_nom"})})
 * @ORM\Entity
 */
class Ressource
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=200, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var float|null
     *
     * @ORM\Column(name="SumRate", type="float", precision=10, scale=0, nullable=true)
     */
    private $sumrate = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateModif", type="date", nullable=false)
     */
    private $datemodif;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=500, nullable=false, options={"default"="D:\jjlamm-test2\src\main\resources\RessourceFX\\info.png"})
     */
    private $img = 'D:\\jjlamm-test2\\src\\main\\resources\\RessourceFX\\\\info.png';

    /**
     * @var string|null
     *
     * @ORM\Column(name="FilePath", type="string", length=500, nullable=true)
     */
    private $filepath;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_nom", referencedColumnName="Nom")
     * })
     */
    private $categorieNom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSumrate(): ?float
    {
        return $this->sumrate;
    }

    public function setSumrate(?float $sumrate): static
    {
        $this->sumrate = $sumrate;

        return $this;
    }

    public function getDatemodif(): ?\DateTimeInterface
    {
        return $this->datemodif;
    }

    public function setDatemodif(\DateTimeInterface $datemodif): static
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getFilepath(): ?string
    {
        return $this->filepath;
    }

    public function setFilepath(?string $filepath): static
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCategorieNom(): ?Categorie
    {
        return $this->categorieNom;
    }

    public function setCategorieNom(?Categorie $categorieNom): static
    {
        $this->categorieNom = $categorieNom;

        return $this;
    }


}
