<?php

namespace App\Entity;

use App\Repository\ReserverEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReserverEventRepository::class)]
class ReserverEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_reservation')]
    private ?int $idReservation = null;

    #[ORM\Column(name: 'id_evenement')]
    private ?int $idEvenement = null;

    #[ORM\Column(name: 'id_user')]
    private ?int $idUser = null;

    #[ORM\Column]
    private ?string $nom = null;

    #[ORM\Column(name: 'nbr_personne')]
    private ?int $nbrPersonne = null;

    #[ORM\Column(name: 'date_reservation')]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column]
    private ?string $email = null;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function getIdEvenement(): ?int
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(?int $idEvenement): self
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
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

    public function getNbrPersonne(): ?int
    {
        return $this->nbrPersonne;
    }

    public function setNbrPersonne(?int $nbrPersonne): self
    {
        $this->nbrPersonne = $nbrPersonne;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(?\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
