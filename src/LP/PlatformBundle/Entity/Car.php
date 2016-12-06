<?php

namespace LP\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * CarA
 *
 * @ORM\Table(name="lp_car")
 * @ORM\Entity(repositoryClass="LP\PlatformBundle\Repository\CarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Car
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
     * @ORM\Column(name="brand", type="string", length=50)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=50)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date")
     *
     *
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="km", type="integer")
     */
    private $km;

    /**
     * @var string
     *
     * @ORM\Column(name="energy", type="string", length=50)
     */
    private $energy;

//    /**
//     * @ORM\OneToOne(targetEntity="LP\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
//     * @Assert\Valid()
//     */
//    private $image;

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
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    /**
     * @return Assert\Date
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param \DateTime $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * @param int $km
     */
    public function setKm(int $km)
    {
        $this->km = $km;
    }

    /**
     * @return string
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @param string $energy
     */
    public function setEnergy(string $energy)
    {
        $this->energy = $energy;
    }

//    /**
//     * @return  Image
//     */
//    public function getImage()
//    {
//        return $this->image;
//    }
//
//    /**
//     * @param Image $image
//     */
//    public function setImage(Image $image)
//    {
//        $this->image = $image;
//    }

    function __toString()
    {
        return $this->brand . " " . $this->model;
    }


}
