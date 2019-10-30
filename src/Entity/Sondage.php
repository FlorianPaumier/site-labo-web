<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SondageRepository")
 */
class Sondage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Themes", inversedBy="sondages")
     */
    private $themes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SondageAnswer", mappedBy="sondage")
     */
    private $sondageAnswers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->sondageAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Themes[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Themes $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
        }

        return $this;
    }

    public function removeTheme(Themes $theme): self
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
        }

        return $this;
    }

    /**
     * @return Collection|SondageAnswer[]
     */
    public function getSondageAnswers(): Collection
    {
        return $this->sondageAnswers;
    }

    public function addSondageAnswer(SondageAnswer $sondageAnswer): self
    {
        if (!$this->sondageAnswers->contains($sondageAnswer)) {
            $this->sondageAnswers[] = $sondageAnswer;
            $sondageAnswer->setSondage($this);
        }

        return $this;
    }

    public function removeSondageAnswer(SondageAnswer $sondageAnswer): self
    {
        if ($this->sondageAnswers->contains($sondageAnswer)) {
            $this->sondageAnswers->removeElement($sondageAnswer);
            // set the owning side to null (unless already changed)
            if ($sondageAnswer->getSondage() === $this) {
                $sondageAnswer->setSondage(null);
            }
        }

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
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
}
