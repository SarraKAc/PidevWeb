<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="id_ressource", columns={"id_ressource"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rate", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRate;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=300, nullable=false)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var \Ressource
     *
     * @ORM\ManyToOne(targetEntity="Ressource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ressource", referencedColumnName="id")
     * })
     */
    private $idRessource;

    public function getIdRate(): ?int
    {
        return $this->idRate;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getIdRessource(): ?Ressource
    {
        return $this->idRessource;
    }

    public function setIdRessource(?Ressource $idRessource): static
    {
        $this->idRessource = $idRessource;

        return $this;
    }


}
