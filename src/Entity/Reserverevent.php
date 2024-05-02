<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reserverevent
 *
 * @ORM\Table(name="reserverevent", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id", columns={"id_user"}), @ORM\Index(name="id_user_2", columns={"id_user"}), @ORM\Index(name="id_evenement", columns={"id_evenement"})})
 * @ORM\Entity
 */
class Reserverevent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_personne", type="integer", nullable=false)
     */
    private $nbrPersonne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id_evenement")
     * })
     */
    private $idEvenement;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
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

    public function getNbrPersonne(): ?int
    {
        return $this->nbrPersonne;
    }

    public function setNbrPersonne(int $nbrPersonne): static
    {
        $this->nbrPersonne = $nbrPersonne;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function getIdEvenement(): ?Evenement
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(?Evenement $idEvenement): static
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }


}
