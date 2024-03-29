<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Language;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TicketRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isSolved = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateTime = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?User $users = null;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: Picture::class, orphanRemoval: true, cascade:['persist'])]
    private Collection $pictures;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'tickets')]
    private Collection $language;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->dateTime = new DateTimeImmutable();
        $this->isSolved = false;
        $this->language = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsSolved(): ?bool
    {
        return $this->isSolved;
    }

    public function setIsSolved(bool $isSolved): static
    {
        $this->isSolved = $isSolved;

        return $this;
    }

    public function getDateTime(): ?\DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeImmutable $dateTime): static
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTicket($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTicket() === $this) {
                $comment->setTicket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setTicket($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getTicket() === $this) {
                $picture->setTicket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->language->contains($language)) {
            $this->language->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->language->removeElement($language);

        return $this;
    }
}
