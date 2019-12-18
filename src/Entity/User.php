<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable()
 */
class User implements UserInterface
{

    use TimestampEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @ORM\Column(type="integer")
     */
    private $point;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Emails", inversedBy="dest")
     */
    private $emails;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cours", inversedBy="attendance")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SondageAnswer", mappedBy="user")
     */
    private $sondageAnswer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Association", mappedBy="participants")
     */
    private $associations;

    /**
     * @Vich\UploadableField(fileNameProperty="thumbnail_name", mapping="profile")
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="thumbnail_name")
     */
    private $thumbnailName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Thread", mappedBy="user")
     */
    private $threads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="author")
     */
    private $events;

    public function __construct()
    {
        $this->point = 0;
        $this->emails = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->sondageAnswer = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associations = new ArrayCollection();
        $this->threads = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function __toString()
    {
       return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(int $point): self
    {
        $this->point = $point;

        return $this;
    }

    /**
     * @return Collection|Emails[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Emails $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
        }

        return $this;
    }

    public function removeEmail(Emails $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
        }

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->contains($cour)) {
            $this->cours->removeElement($cour);
        }

        return $this;
    }

    /**
     * @return Collection|SondageAnswer[]
     */
    public function getSondageAnswer(): Collection
    {
        return $this->sondageAnswer;
    }

    public function addSondageAnswer(SondageAnswer $sondageAnswer): self
    {
        if (!$this->sondageAnswer->contains($sondageAnswer)) {
            $this->sondageAnswer[] = $sondageAnswer;
            $sondageAnswer->setUsers($this);
        }

        return $this;
    }

    public function removeSondageAnswer(SondageAnswer $sondageAnswer): self
    {
        if ($this->sondageAnswer->contains($sondageAnswer)) {
            $this->sondageAnswer->removeElement($sondageAnswer);
            // set the owning side to null (unless already changed)
            if ($sondageAnswer->getUsers() === $this) {
                $sondageAnswer->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Association[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->addParticipant($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
            $association->removeParticipant($this);
        }

        return $this;
    }


    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function setThumbnail(File $thumbnailFile)
    {
        $this->thumbnail = $thumbnailFile;

        if (null !== $thumbnailFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getThumbnailName()
    {
        return $this->thumbnailName;
    }

    public function setThumbnailName(string $thumbnailName)
    {
        $this->thumbnailName = $thumbnailName;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return User
     */
    public function setToken(string $token): User
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return Collection|Thread[]
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads[] = $thread;
            $thread->addUser($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            $thread->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setAuthor($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getAuthor() === $this) {
                $event->setAuthor(null);
            }
        }

        return $this;
    }


}
