<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction", indexes={@ORM\Index(name="ressource_id", columns={"ressource_id"}), @ORM\Index(name="buyer_id", columns={"buyer_id"})})
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="transaction_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transactionId;

    /**
     * @var \Ressource
     *
     * @ORM\ManyToOne(targetEntity="Ressource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ressource_id", referencedColumnName="id")
     * })
     */
    private $ressource;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="buyer_id", referencedColumnName="id")
     * })
     */
    private $buyer;

    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    public function getRessource(): ?Ressource
    {
        return $this->ressource;
    }

    public function setRessource(?Ressource $ressource): static
    {
        $this->ressource = $ressource;

        return $this;
    }

    public function getBuyer(): ?Utilisateur
    {
        return $this->buyer;
    }

    public function setBuyer(?Utilisateur $buyer): static
    {
        $this->buyer = $buyer;

        return $this;
    }


}
