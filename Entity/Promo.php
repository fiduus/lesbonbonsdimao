<?php

namespace fidi\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table("promo")
 * @ORM\Entity
 */
class Promo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_reduction", type="string", length=255)
     */
    private $nomReduction;

    /**
     * @var string
     *
     * @ORM\Column(name="pourcentage", type="decimal")
     */
    private $pourcentage;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomReduction
     *
     * @param string $nomReduction
     * @return Promo
     */
    public function setNomReduction($nomReduction)
    {
        $this->nomReduction = $nomReduction;

        return $this;
    }

    /**
     * Get nomReduction
     *
     * @return string 
     */
    public function getNomReduction()
    {
        return $this->nomReduction;
    }

    /**
     * Set pourcentage
     *
     * @param string $pourcentage
     * @return Promo
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return string 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }
}
