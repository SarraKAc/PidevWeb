<?php

namespace App\Entity;

use App\Repository\ReserverEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReserverEventRepository::class)]
class ReserverEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name: "id_reservation")]
    private ?int $id_reservation = null;

    #[ORM\ManyToOne(targetEntity: "Evenement")]
    #[ORM\JoinColumn(name: "id_evenement", nullable: false, referencedColumnName:"id_evenement")]
    private ?Evenement $evenement;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbr_personne = null;

    /*#[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_reservation = null;*/

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_reservation = null;


    /*#[ORM\Column(length: 255)]
    private ?string $email = null;*/

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne peut pas être vide")]
    #[Assert\Email(message: "L'adresse e-mail '{{ value }}' n'est pas valide.")]
    #[Assert\Callback(callbacks: ["validateEmail"])]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id_reservation;
    }
    public function setIdReservation(int $id_reservation): static
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
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
        return $this->nbr_personne;
    }

    public function setNbrPersonne(int $nbr_personne): static
    {
        $this->nbr_personne = $nbr_personne;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): static
    {
        $this->date_reservation = $date_reservation;

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

    public function validateEmail(ExecutionContextInterface $context, $payload)
    {
        // Vérifier si l'email contient un point et un '@'
        if (!strpos($this->email, '.') || !strpos($this->email, '@')) {
            $context->buildViolation("L'email doit contenir un point (.) et un symbole '@'")
                ->atPath('email')
                ->addViolation();
        }
    }

   
}
