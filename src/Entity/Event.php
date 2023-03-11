<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'events')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getEvents"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["getEvents"])]
    private ?string $label = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["getEvents"])]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["getEvents"])]
    private ?\DateTimeInterface $date_end = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["getEvents"])]
    private ?bool $all_day = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(["getEvents"])]
    private ?string $background_color = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["getEvents"])]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(["getEvents"])]
    private ?string $location = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, mappedBy: 'event')]
    #[Groups(["getEvents"])]
    private Collection $contacts;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Invite::class, orphanRemoval: true)]
    private Collection $invites;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->invites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function isAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(?bool $all_day): self
    {
        $this->all_day = $all_day;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(?string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection <int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->addEvent($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            $contact->removeEvent($this);
        }

        return $this;
    }

    /**
     * @return Collection <int, Invite>
     */
    public function getInvites(): Collection
    {
        return $this->invites;
    }

    public function addInvite(Invite $invite): self
    {
        if (!$this->invites->contains($invite)) {
            $this->invites->add($invite);
            $invite->setEvent($this);
        }

        return $this;
    }

    public function removeInvite(Invite $invite): self
    {
        if ($this->invites->removeElement($invite)) {
            // set the owning side to null (unless already changed)
            if ($invite->getEvent() === $this) {
                $invite->setEvent(null);
            }
        }

        return $this;
    }
}
