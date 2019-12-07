<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class TimestampEntity
 * @ORM\HasLifecycleCallbacks()
 * @package App\Entity
 */
trait TimestampEntity
{

    /**
     * @ORM\Column(type="date", options={"default" : "2019-01-01"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date", options={"default" : "2019-01-01"})
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return TimestampEntity
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return TimestampEntity
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function createDate(){
        $this->createdAt = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     */
    public function updateDate()
    {
        $this->updatedAt = new \DateTime();
    }
}