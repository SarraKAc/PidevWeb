<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id_topic = null;


    #[Assert\Length(
        min: 5,
        max: 20,
        minMessage: "La longueur minimale doit être de {{ limit }} caractères",
        maxMessage: "La longueur maximale doit être de {{ limit }} caractères"
    )]
    #[ORM\Column(length: 255)]
    public ?string $titre_topic = null;


    #[Assert\Length(
        min: 20,
        minMessage: "La longueur minimale doit être de {{ limit }} caractères",
    )]
    #[ORM\Column(length: 255)]
    public ?string $contenu = null;

    #[ORM\Column]
    public ?int $id_user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    public ?string $image = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'id_topic')]
    private Collection $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }



    public function getIdTopic(): ?int
    {
        return $this->id_topic;
    }



    public function getTitreTopic(): ?string
    {
        return $this->titre_topic;
    }

    public function setTitreTopic(string $titre_topic): static
    {
        $this->titre_topic = $titre_topic;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setIdTopic($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdTopic() === $this) {
                $commentaire->setIdTopic(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->id_topic; // Ou toute autre information pertinente à afficher sous forme de chaîne
    }
}
