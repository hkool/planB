<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelling
 *
 * @ORM\Table(name="bestellingen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestellingRepository")
 */
class Bestelling
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
     * @ORM\Column(name="klantnaam", type="string", length=100)
     */
    private $klantnaam;

    /**
     * @var string
     *
     * @ORM\Column(name="telefoon", type="string", length=15)
     */
    private $telefoon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="afhaaldatum", type="datetime")
     */
    private $afhaaldatum;

    /**
     * @ORM\OneToMany(targetEntity="Bestelregel", mappedBy="bestelling")
     */
    private $bestelregels;


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
     * Set klantnaam
     *
     * @param string $klantnaam
     *
     * @return Bestelling
     */
    public function setKlantnaam($klantnaam)
    {
        $this->klantnaam = $klantnaam;

        return $this;
    }

    /**
     * Get klantnaam
     *
     * @return string
     */
    public function getKlantnaam()
    {
        return $this->klantnaam;
    }

    /**
     * Set telefoon
     *
     * @param string $telefoon
     *
     * @return Bestelling
     */
    public function setTelefoon($telefoon)
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return string
     */
    public function getTelefoon()
    {
        return $this->telefoon;
    }

    /**
     * Set afhaaldatum
     *
     * @param \DateTime $afhaaldatum
     *
     * @return Bestelling
     */
    public function setAfhaaldatum($afhaaldatum)
    {
        $this->afhaaldatum = $afhaaldatum;

        return $this;
    }

    /**
     * Get afhaaldatum
     *
     * @return \DateTime
     */
    public function getAfhaaldatum()
    {
        return $this->afhaaldatum;
    }/**
 * @return mixed
 */
    public function getBestelregels()
    {
        return $this->bestelregels;
    }

    /**
     * @param mixed $bestelregels
     */
    public function setBestelregels($bestelregels)
    {
        $this->bestelregels = $bestelregels;
    }
}

