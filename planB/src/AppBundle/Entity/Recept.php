<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recept
 *
 * @ORM\Table(name="recepten")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReceptRepository")
 */
class Recept
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
     * @ORM\Column(name="naam", type="string", length=255)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="kostenPerLiter", type="decimal", precision=5, scale=2)
     */
    private $kostenPerLiter;
    /**
     * @var string
     *
     * @ORM\Column(name="bereidingswijze", type="string", length=255)
     */
    private $bereidingswijze;
    /**
     * @ORM\ManyToOne(targetEntity="Fruit", inversedBy="recepten")
     *
     */
    private $fruit;



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
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param string $beschrijving
     */
    public function setNaam($beschrijving)
    {
        $this->naam = $beschrijving;
    }



    /**
     * Set kostenPerLiter
     *
     * @param string $kostenPerLiter
     *
     * @return Recept
     */
    public function setKostenPerLiter($kostenPerLiter)
    {
        $this->kostenPerLiter = $kostenPerLiter;

        return $this;
    }

    /**
     * Get kostenPerLiter
     *
     * @return string
     */
    public function getKostenPerLiter()
    {
        return $this->kostenPerLiter;
    }

    /**
     * @return mixed
     */
    public function getFruit()
    {
        return $this->fruit;
    }

    /**
     * @param mixed $fruit
     */
    public function setFruit($fruit)
    {
        $this->fruit = $fruit;
    }

    /**
     * @return string
     */
    public function getBereidingswijze()
    {
        return $this->bereidingswijze;
    }

    /**
     * @param string $bereidingswijze
     */
    public function setBereidingswijze($bereidingswijze)
    {
        $this->bereidingswijze = $bereidingswijze;
    }
}

