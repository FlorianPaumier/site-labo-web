<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="cours")
     */
    private $attendance;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="cours")
     */
    private $users;

    public function __construct()
    {
        $this->attendance = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAttendance(): Collection
    {
        return $this->attendance;
    }

    public function addAttendance(User $attendance): self
    {
        if (!$this->attendance->contains($attendance)) {
            $this->attendance[] = $attendance;
        }

        return $this;
    }

    public function removeAttendance(User $attendance): self
    {
        if ($this->attendance->contains($attendance)) {
            $this->attendance->removeElement($attendance);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCour($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeCour($this);
        }

        return $this;
    }
}
