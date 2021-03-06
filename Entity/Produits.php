<?php

namespace fidi\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Produits
 *
 * @ORM\Table("produits")
 * @ORM\Entity(repositoryClass="fidi\EcommerceBundle\Repository\ProduitsRepository")
 * @GRID\Source(columns="id,stock, tva, nom, description, prix", groupBy={"id"})
 */
class Produits
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
     * @var integer
     * @ORM\Column(name="stock", type="integer")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");     
     * @Assert\LessThan(300, message = "Veuillez saisir un chiffre inférieur à 300")
     * 
     */
    private $stock;
    
    /**
     * @ORM\OneToOne(targetEntity="fidi\EcommerceBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;
    
    /**
     * @ORM\OneToOne(targetEntity="fidi\EcommerceBundle\Entity\MediaDescr", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $imageDescription;
    
    /**
     * @ORM\ManyToOne(targetEntity="fidi\EcommerceBundle\Entity\Categories", cascade={"persist"})
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * @GRID\Column(field="categorie.nom", title="Nom Categorie")
     * @GRID\Column(field="categorie.nom", title="Nom Categorie", translation_domain="categories")
     */
    private $categorie;
    
    /**
     * @ORM\ManyToOne(targetEntity="fidi\EcommerceBundle\Entity\Tva", cascade={"persist"})
     * @ORM\JoinColumn(name="tva_id", referencedColumnName="id")
     */
    private $tva;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=125)
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     * @Assert\Length(min="2", max="50");
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom2", type="string", length=125)     
     * @Assert\Length(min="2", max="50");
     */
    private $nom2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     * @Assert\Length(min="2", max="1200");
     */
    private $description;
    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     */
    private $prix;    
    /**
     * @var string
     *
     * @ORM\Column(name="vertu", type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     * @Assert\Length(min="2", max="1200");
     */
    private $vertu;
    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     */
    private $composition;  
    
    /**
     * @var string
     *
     * @ORM\Column(name="valnut", type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
    */
    private $valnut;
    
    /**
     * @var string
     *
     * @ORM\Column(name="poids", type="float")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
    */
    private $poids;
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
     * Set nom
     *
     * @param string $nom
     * @return Produits
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    /**
     * Set nom2
     *
     * @param string $nom2
     * @return Produits
     */
    public function setNom2($nom2)
    {
        $this->nom2 = $nom2;
        return $this;
    }
    /**
     * Get nom2
     *
     * @return string 
     */
    public function getNom2()
    {
        return $this->nom2;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return Produits
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set prix
     *
     * @param float $prix
     * @return Produits
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }
    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }    
    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Media $image
     * @return Produits
     */
    public function setImage(\fidi\EcommerceBundle\Entity\Media $image)
    {
        $this->image = $image;
        return $this;
    }
    /**
     * Get image
     *
     * @return \fidi\EcommerceBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set categorie
     *
     * @param \fidi\EcommerceBundle\Entity\Categories $categorie
     * @return Produits
     */
    public function setCategorie(\fidi\EcommerceBundle\Entity\Categories $categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }
    /**
     * Get categorie
     *
     * @return \fidi\EcommerceBundle\Entity\Categories 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Set tva
     *
     * @param \fidi\EcommerceBundle\Entity\Tva $tva
     * @return Produits
     */
    public function setTva(\fidi\EcommerceBundle\Entity\Tva $tva)
    {
        $this->tva = $tva;
        return $this;
    }
    /**
     * Get tva
     *
     * @return \fidi\EcommerceBundle\Entity\Tva 
     */
    public function getTva()
    {
        return $this->tva;
    }
    /**
     * Set stock
     *
     * @param integer $stock
     * @return Produits
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set vertu
     *
     * @param string $vertu
     * @return Produits
     */
    public function setVertu($vertu)
    {
        $this->vertu = $vertu;

        return $this;
    }

    /**
     * Get vertu
     *
     * @return string 
     */
    public function getVertu()
    {
        return $this->vertu;
    }

    /**
     * Set composition
     *
     * @param string $composition
     * @return Produits
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * Get composition
     *
     * @return string 
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Set valnut
     *
     * @param string $valnut
     * @return Produits
     */
    public function setValnut($valnut)
    {
        $this->valnut = $valnut;

        return $this;
    }

    /**
     * Get valnut
     *
     * @return string 
     */
    public function getValnut()
    {
        return $this->valnut;
    }

    /**
     * Set poids
     *
     * @param float $poids
     * @return Produits
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return float 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set imageDescription
     *
     * @param \fidi\EcommerceBundle\Entity\MediaDescr $imageDescription
     * @return Produits
     */
    public function setImageDescription(\fidi\EcommerceBundle\Entity\MediaDescr $imageDescription)
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }

    /**
     * Get imageDescription
     *
     * @return \fidi\EcommerceBundle\Entity\MediaDescr 
     */
    public function getImageDescription()
    {
        return $this->imageDescription;
    }
}
