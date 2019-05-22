<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fruit
 *
 * @ORM\Table(name="fruit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FruitRepository")
 */
class Fruit
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
     * @ORM\Column(name="naam", type="string", length=50, unique=true)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="seizoen", type="string", length=10)
     */
    private $seizoen;
    /**
     * @ORM\OneToOne(targetEntity="Recept", mappedBy="fruit", fetch="LAZY")
     */
    private $recept;
    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg", "images/jpg" })
     */
    private $image;
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
     * Set naam
     *
     * @param string $naam
     *
     * @return Fruit
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set seizoen
     *
     * @param string $seizoen
     *
     * @return Fruit
     */
    public function setSeizoen($seizoen)
    {
        $this->seizoen = $seizoen;

        return $this;
    }

    /**
     * Get seizoen
     *
     * @return string
     */
    public function getSeizoen()
    {
        return $this->seizoen;
    }

    /**
     * @return mixed
     */
    public function getRecept()
    {
        return $this->recept;
    }

    /**
     * @param mixed $recepten
     */
    public function setRecept($recept)
    {
        $this->recept = $recept;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}

