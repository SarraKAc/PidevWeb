<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Messagerie
 *
 * @ORM\Table(name="messagerie", indexes={@ORM\Index(name="id_sender", columns={"id_sender"}), @ORM\Index(name="id_receiver", columns={"id_receiver"})})
 * @ORM\Entity
 */
class Messagerie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_m", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idM;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=256, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateMessage = 'CURRENT_TIMESTAMP';

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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_receiver", referencedColumnName="id")
     * })
     */
    private $idReceiver;

    public function getIdM(): ?int
    {
        return $this->idM;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): static
    {
        $this->dateMessage = $dateMessage;

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
