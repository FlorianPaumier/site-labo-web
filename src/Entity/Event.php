<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Exclude()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose()
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose()
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose()
     */
    private $happensAt;

    /**
     * @ORM\Column(type="text", length=255)
     * @JMS\Expose()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose()
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Association", inversedBy="events")
     * @JMS\Expose()
     * @JMS\MaxDepth(1)
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @JMS\Exclude()
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getHappensAt(): ?\DateTimeInterface
    {
        return $this->happensAt;
    }

    public function setHappensAt(\DateTimeInterface $happensAt): self
    {
        $this->happensAt = $happensAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
