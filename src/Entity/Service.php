<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="prix", columns={"prix"}), @ORM\Index(name="fk_serviceUser", columns={"id_user"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_service", type="string", length=255, nullable=false)
     */
    private $nomService;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_service", type="string", length=255, nullable=false)
     */
    private $titreService;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="tmpService", type="string", length=255, nullable=false)
     */
    private $tmpservice;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=255, nullable=false)
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=500, nullable=false)
     */
    private $img;

    /**
     * @var float|null
     *
     * @ORM\Column(name="PrixSolde", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixsolde;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    public function getIdService(): ?int
    {
        return $this->idService;
    }

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): static
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getTitreService(): ?string
    {
        return $this->titreService;
    }

    public function setTitreService(string $titreService): static
    {
        $this->titreService = $titreService;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTmpservice(): ?string
    {
        return $this->tmpservice;
    }

    public function setTmpservice(string $tmpservice): static
    {
        $this->tmpservice = $tmpservice;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): static
    {
        $this->domaine = $domaine;

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

    public function getPrixsolde(): ?float
    {
        return $this->prixsolde;
    }

    public function setPrixsolde(?float $prixsolde): static
    {
        $this->prixsolde = $prixsolde;

        return $this;
    }

    public function getIdUser(): ?Utilisateur
    {
        return $this->idUser;
    }

    public function setIdUser(?Utilisateur $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }
    public function __toString(): string
    {

        return $this->nomService; // Ou toute autre information pertinente à afficher sous forme de chaîne
    }


}
