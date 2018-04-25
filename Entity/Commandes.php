<?php

namespace fidi\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commandes
 *
 * @ORM\Table("commandes")
 * @ORM\Entity(repositoryClass="fidi\EcommerceBundle\Repository\CommandesRepository")
 * @GRID\Source(columns="id,utilisateur.adresses.nom,valider, date,reference", groupBy={"id"})
 */
class Commandes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="fidi\UserBundle\Entity\User", inversedBy="commandes")
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")   
     * 
     */
    
    private $utilisateur;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="valider", type="boolean")
     */
    private $valider;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;
    /**
     * @var array
     * 
     * @ORM\Column(name="commande", type="array")
     * @GRID\Column(field="commande", type="array", title="Commandes")
     * 
     */
    private $commande;
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
     * Set valider
     *
     * @param boolean $valider
     * @return Commandes
     */
    public function setValider($valider)
    {
        $this->valider = $valider;
        return $this;
    }
    /**
     * Get valider
     *
     * @return boolean 
     */
    public function getValider()
    {
        return $this->valider;
    }
    /**
     * Set date
     *
     * @param \Date $date
     * @return Commandes
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * Get date
     *
     * @return \Date 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set reference
     *
     * @param integer $reference
     * @return Commandes
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
    /**
     * Get reference
     *
     * @return integer 
     */
    public function getReference()
    {
        return $this->reference;
    }
    /**
     * Set commande
     *
     * @param array $commande
     * @return Commandes
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
        return $this;
    }
    /**
     * Get commande
     *
     * @return array 
     */
    public function getCommande()
    {
        return $this->commande;
    }
    /**
     * Set utilisateur
     *
     * @param \fidi\UserBundle\Entity\User $utilisateur
     * @return Commandes
     */
    public function setUtilisateur(\fidi\UserBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }
    /**
     * Get utilisateur
     *
     * @return \fidi\UserBundle\Entity\User $utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
