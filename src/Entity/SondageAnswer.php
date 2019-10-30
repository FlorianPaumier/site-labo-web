<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SondageAnswerRepository")
 */
class SondageAnswer
{
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Themes", inversedBy="sondageAnswers")
     */
    private $themes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sondage", inversedBy="sondageAnswers")
     */
    private $sondage;

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

    public function getThemes(): ?Themes
    {
        return $this->themes;
    }

    public function setThemes(?Themes $themes): self
    {
        $this->themes = $themes;

        return $this;
    }

    public function getSondage(): ?Sondage
    {
        return $this->sondage;
    }

    public function setSondage(?Sondage $sondage): self
    {
        $this->sondage = $sondage;

        return $this;
    }
}
