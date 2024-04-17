<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_com = null;


    #[Assert\Length(
        max: 40,
        maxMessage: "La longueur maximale doit être de {{ limit }} caractères"
    )]
    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_com = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(name: "id_topic", referencedColumnName: "id_topic", nullable: false)]
    private ?Topic $id_topic = null;


    public function getIdCom(): ?int
    {
        return $this->id_com;
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

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(\DateTimeInterface $date_com): static
    {
        $this->date_com = $date_com;

        return $this;
    }

    public function getIdTopic(): ?Topic
    {
        return $this->id_topic;
    }

    public function setIdTopic(?Topic $id_topic): static
    {
        $this->id_topic = $id_topic;

        return $this;
    }
}
