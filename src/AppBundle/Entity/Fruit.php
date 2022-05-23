<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="naam", type="string", length=25)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="seizoen", type="string", length=6)
     */
    private $seizoen;

    /**
     * @var string
     *
     * @ORM\Column(name="afbeelding", type="string", length=100, unique=true)
     */
    private $afbeelding;

    /**
     * @ORM\OneToMany(targetEntity="Recept", mappedBy="fruit")
     * @ORM\JoinColumn(name="fruit_id", referencedColumnName="id")
     */
    private $recepten;
    /*
    functie vult recepten met entities uit de tabel die verbonden zijn aan de entity fruit
    */
    public function __construct()
    {
        $this->recepten = new ArrayCollection();
    }
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
     * Set afbeelding
     *
     * @param string $afbeelding
     *
     * @return Fruit
     */
    public function setAfbeelding($afbeelding)
    {
        $this->afbeelding = $afbeelding;

        return $this;
    }

    /**
     * Get afbeelding
     *
     * @return string
     */
    public function getAfbeelding()
    {
        return $this->afbeelding;
    }

    /**
     * @return mixed
     */
    public function getRecepten()
    {
        return $this->recepten;
    }

    /**
     * @param mixed $recepten
     */
    public function setRecepten($recepten)
    {
        $this->recepten = $recepten;
    }
}

