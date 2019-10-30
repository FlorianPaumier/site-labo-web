<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThèmesRepository")
 */
class Themes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sondage", mappedBy="themes")
     */
    private $sondages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SondageAnswer", mappedBy="themes")
     */
    private $sondageAnswers;

    public function __construct()
    {
        $this->sondages = new ArrayCollection();
        $this->sondageAnswers = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

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

    /**
     * @return Collection|Sondage[]
     */
    public function getSondages(): Collection
    {
        return $this->sondages;
    }

    public function addSondage(Sondage $sondage): self
    {
        if (!$this->sondages->contains($sondage)) {
            $this->sondages[] = $sondage;
            $sondage->addTheme($this);
        }

        return $this;
    }

    public function removeSondage(Sondage $sondage): self
    {
        if ($this->sondages->contains($sondage)) {
            $this->sondages->removeElement($sondage);
            $sondage->removeTheme($this);
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
            $sondageAnswer->setThemes($this);
        }

        return $this;
    }

    public function removeSondageAnswer(SondageAnswer $sondageAnswer): self
    {
        if ($this->sondageAnswers->contains($sondageAnswer)) {
            $this->sondageAnswers->removeElement($sondageAnswer);
            // set the owning side to null (unless already changed)
            if ($sondageAnswer->getThemes() === $this) {
                $sondageAnswer->setThemes(null);
            }
        }

        return $this;
    }
}
