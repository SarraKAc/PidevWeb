<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="id_service", columns={"id_service"})})
 * @ORM\Entity
 */
class Avis
{

    /**
     * @var int
     *
     * @ORM\Column(name="id_avis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_etoile", type="integer", nullable=false)
     * @Assert\NotBlank(message="Veuillez fournir un nombre d'étoiles.")
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Le nombre d'étoiles doit être au moins {{ limit }}.",
     *      maxMessage = "Le nombre d'étoiles ne peut pas dépasser {{ limit }}."
     * )
     */
    private $nbrEtoile;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="Veuillez fournir un texte.")
     */
    private $text;
    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id_service")
     * })
     */
    private $idService;

    public function getIdAvis(): ?int
    {
        return $this->idAvis;
    }

    public function getNbrEtoile(): ?int
    {
        return $this->nbrEtoile;
    }

    public function setNbrEtoile(int $nbrEtoile): static
    {
        $this->nbrEtoile = $nbrEtoile;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getIdService(): ?Service
    {
        return $this->idService;
    }

    public function setIdService(?Service $idService): static
    {
        $this->idService = $idService;

        return $this;
    }


}
