<?php

namespace LP\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Advert
 *
 * @ORM\Table(name="lp_advert")
 * @ORM\Entity(repositoryClass="LP\PlatformBundle\Repository\AdvertRepository")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="LP\PlatformBundle\Entity\Car", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $car;

    /**
     * @ORM\OneToOne(targetEntity="LP\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePosted", type="date")
     */
    private $datePosted;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDatePosted()
    {
        return $this->datePosted;
    }

    /**
     * @param \DateTime $datePosted
     */
    public function setDatePosted(\DateTime $datePosted)
    {
        $this->datePosted = $datePosted;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return  Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return  Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * @param Car $car
     */
    public function setCar(Car $car)
    {
        $this->car = $car;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @ORM\PrePersist
     */
    public function setAutomaticDateposted()
    {
        $this->setDatePosted(new \Datetime());
    }
}
