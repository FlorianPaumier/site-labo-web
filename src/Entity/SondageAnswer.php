<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SondageAnswerRepository")
 */
class SondageAnswer
{

    use TimestampEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sondageAnswers")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SondageQuestion", inversedBy="sondageAnswers")
     */
    private $sondage;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSondage()
    {
        return $this->sondage;
    }

    /**
     * @param mixed $sondage
     * @return SondageAnswer
     */
    public function setSondage($sondage)
    {
        $this->sondage = $sondage;
        return $this;
    }
}
