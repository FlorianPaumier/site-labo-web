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

    use TimestampEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SondageAnswer", mappedBy="sondage", cascade={"remove"})
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SondageQuestion", mappedBy="sondage", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $sondageQuestions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Association", inversedBy="sondages")
     */
    private $association;

    public function __construct()
    {
        $this->sondageAnswers = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->sondageQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|SondageQuestion[]
     */
    public function getSondageQuestions(): Collection
    {
        return $this->sondageQuestions;
    }

    public function addSondageQuestion(SondageQuestion $sondageQuestion): self
    {
        if (!$this->sondageQuestions->contains($sondageQuestion)) {
            $this->sondageQuestions[] = $sondageQuestion;
            $sondageQuestion->setSondage($this);
        }

        return $this;
    }

    public function removeSondageQuestion(SondageQuestion $sondageQuestion): self
    {
        if ($this->sondageQuestions->contains($sondageQuestion)) {
            $this->sondageQuestions->removeElement($sondageQuestion);
            // set the owning side to null (unless already changed)
            if ($sondageQuestion->getSondage() === $this) {
                $sondageQuestion->setSondage(null);
            }
        }

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
}
