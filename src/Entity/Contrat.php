<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="id_m", columns={"id_m"}), @ORM\Index(name="id_sender", columns={"id_sender"}), @ORM\Index(name="id_receiver", columns={"id_receiver"})})
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_c", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idC;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var float|null
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=true)
     */
    private $duree;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=256, nullable=true)
     */
    private $description;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sender", referencedColumnName="id")
     * })
     */
    private $idSender;

    /**
     * @var \Messagerie
     *
     * @ORM\ManyToOne(targetEntity="Messagerie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_m", referencedColumnName="id_m")
     * })
     */
    private $idM;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receiver", referencedColumnName="id")
     * })
     */
    private $idReceiver;

    public function getIdC(): ?int
    {
        return $this->idC;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDuree(): ?float
    {
        return $this->duree;
    }

    public function setDuree(?float $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getIdSender(): ?Utilisateur
    {
        return $this->idSender;
    }

    public function setIdSender(?Utilisateur $idSender): static
    {
        $this->idSender = $idSender;

        return $this;
    }

    public function getIdM(): ?Messagerie
    {
        return $this->idM;
    }

    public function setIdM(?Messagerie $idM): static
    {
        $this->idM = $idM;

        return $this;
    }

    public function getIdReceiver(): ?Utilisateur
    {
        return $this->idReceiver;
    }

    public function setIdReceiver(?Utilisateur $idReceiver): static
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }


}
