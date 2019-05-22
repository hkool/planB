<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bestelregel
 *
 * @ORM\Table(name="bestelregel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestelregelRepository")
 */
class Bestelregel
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
     * @ORM\ManyToOne(targetEntity="Bestelling", inversedBy="bestelregels", cascade={"persist"})
     *
     */
    private $bestelling;
    /**
     * @ORM\ManyToOne(targetEntity="Recept", inversedBy="bestellingen", cascade={"persist"})
     *
     */
    private $recept;
    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer")
     */
    private $aantal;


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
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return Bestelregel
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
    }

    /**
     * @return mixed
     */
    public function getBestelling()
    {
        return $this->bestelling;
    }

    /**
     * @param mixed $bestelling
     */
    public function setBestelling($bestelling)
    {
        $this->bestelling = $bestelling;
    }

    /**
     * @return mixed
     */
    public function getRecept()
    {
        return $this->recept;
    }

    /**
     * @param mixed $recept
     */
    public function setRecept($recept)
    {
        $this->recept = $recept;
    }
}

