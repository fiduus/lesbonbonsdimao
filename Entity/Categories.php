<?php

namespace fidi\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Categories
 *
 * @ORM\Table("categories")
 * @ORM\Entity(repositoryClass="fidi\EcommerceBundle\Repository\CategoriesRepository")
 */
class Categories
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
     * @ORM\OneToOne(targetEntity="fidi\EcommerceBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;
    
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
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide");
     * @Assert\Length(min="2", max="50");
     */
    private $nom2;
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
     * @return Categories
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
     * Set image
     *
     * @param \fidi\EcommerceBundle\Entity\Media $image
     * @return Categories
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
    
    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * Set nom2
     *
     * @param string $nom2
     * @return Categories
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
}
