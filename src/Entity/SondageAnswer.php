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
     * @ORM\ManyToOne(targetEntity="App\Entity\SondageQuestion", inversedBy="answers")
     */
    private $sondageQuestion;

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

    public function getSondageQuestion(): ?SondageQuestion
    {
        return $this->sondageQuestion;
    }

    public function setSondageQuestion(?SondageQuestion $sondageQuestion): self
    {
        $this->sondageQuestion = $sondageQuestion;

        return $this;
    }
}
