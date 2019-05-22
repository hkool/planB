<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelling
 *
 * @ORM\Table(name="bestelling")
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
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Bestelregel", mappedBy="bestelling")
     * @ORM\JoinColumn(name="bestelling_id", referencedColumnName="id")
     */
    private $bestelregels;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Recept", mappedBy="bestelling")
     * @ORM\JoinColumn(name="bestelling_id",referencedColumnName="id")
     */
    private $recepten;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="afhaaldatum", type="date")
     */
    private $afhaaldatum;

    /**
     * @var string
     *
     * @ORM\Column(name="klant", type="string", length=255)
     */
    private $klant;

    /**
     * @var string
     *
     * @ORM\Column(name="telefoon", type="string", length=15)
     */
    private $telefoon;

    public function __construct()
    {
        $this->bestelregels = new ArrayCollection();
    }
    public function addBR(Bstelregel $bestelregel)
    {
        $this->bestelregels->add($bestelregel);
    }

    public function removeBR(Bestelregel $bestelregel)
    {
        $this->bestelregels->removeElement($bestelregel);
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
     * Set bestelregels
     *
     * @param array $bestelregels
     *
     * @return Bestelling
     */
    public function setBestelregels($bestelregels)
    {
        $this->bestelregels = $bestelregels;

        return $this;
    }

    /**
     * Get bestelregels
     *
     * @return array
     */
    public function getBestelregels()
    {
        return $this->bestelregels;
    }

    /**
     * Set recepten
     *
     * @param array $recepten
     *
     * @return Bestelling
     */
    public function setRecepten($recepten)
    {
        $this->recepten = $recepten;

        return $this;
    }

    /**
     * Get recepten
     *
     * @return array
     */
    public function getRecepten()
    {
        return $this->recepten;
    }

    /**
     * @return \DateTime
     */
    public function getAfhaaldatum()
    {
        return $this->afhaaldatum;
    }

    /**
     * @param \DateTime $afhaaldatum
     */
    public function setAfhaaldatum($afhaaldatum)
    {
        $this->afhaaldatum = $afhaaldatum;
    }



    /**
     * Set klant
     *
     * @param string $klant
     *
     * @return Bestelling
     */
    public function setKlant($klant)
    {
        $this->klant = $klant;

        return $this;
    }

    /**
     * Get klant
     *
     * @return string
     */
    public function getKlant()
    {
        return $this->klant;
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
}

