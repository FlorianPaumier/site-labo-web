<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmailsRepository")
 */
class Emails
{

    use TimestampEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $dest;


    public function __construct()
    {
        $this->dest = new ArrayCollection();
        $this->users = new ArrayCollection();

        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getDest(): Collection
    {
        return $this->dest;
    }

    public function addDest(User $dest): self
    {
        if (!$this->dest->contains($dest)) {
            $this->dest[] = $dest;
            $dest->addEmail($this);
        }

        return $this;
    }

    public function removeDest(User $dest): self
    {
        if ($this->dest->contains($dest)) {
            $this->dest->removeElement($dest);
            $dest->removeEmail($this);
        }

        return $this;
    }
}
