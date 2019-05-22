<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Recept
 *
 * @ORM\Table(name="recept")
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
     * @ORM\Column(name="naam", type="string", length=50, unique=true)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="bereiding", type="text")
     */
    private $bereidingswijze;

    /**
     * @var string
     *
     * @ORM\Column(name="prijsPerLiter", type="decimal", precision=5, scale=2)
     * @Assert\Type("double")
     */
    private $prijsPerLiter;
    /**
     * @ORM\OneToMany(targetEntity="Bestelregel", mappedBy="recept")
     * @ORM\JoinColumn(name="recept_id", referencedColumnName="id")
     */
    private $bestellingen;
    /**
     * @ORM\OneToOne(targetEntity="Fruit", inversedBy="recept")
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
     * Set naam
     *
     * @param string $naam
     *
     * @return Recept
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
     * Set prijsPerLiter
     *
     * @param string $prijsPerLiter
     *
     * @return Recept
     */
    public function setPrijsPerLiter($prijsPerLiter)
    {
        $this->prijsPerLiter = $prijsPerLiter;

        return $this;
    }

    /**
     * Get prijsPerLiter
     *
     * @return string
     */
    public function getPrijsPerLiter()
    {
        return $this->prijsPerLiter;
    }


    /**
     * @return mixed
     */
    public function getBestellingen()
    {
        return $this->bestellingen;
    }

    /**
     * @param mixed $bestellingen
     */
    public function setBestellingen($bestellingen)
    {
        $this->bestellingen = $bestellingen;
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
}

