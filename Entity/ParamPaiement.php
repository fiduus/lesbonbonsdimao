<?php

namespace fidi\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParamPaiement
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ParamPaiement
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
     * @ORM\Column(name="pbx_site", type="string", length=255)
     */
    private $pbxSite;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_rang", type="string", length=255)
     */
    private $pbxRang;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_identifiant", type="string", length=255)
     */
    private $pbxIdentifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_cmd", type="string", length=255)
     */
    private $pbxCmd;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_porteur", type="string", length=255)
     */
    private $pbxPorteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="$pbx_total", type="integer")
     */
    private $pbxTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="pbx_devise", type="integer")
     */
    private $pbxDevise;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_effectue", type="string", length=255)
     */
    private $pbxEffectue;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_annule", type="string", length=255)
     */
    private $pbxAnnule;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_refuse", type="string", length=255)
     */
    private $pbxRefuse;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_repondre_a", type="string", length=255)
     */
    private $pbxRepondreA;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_retour", type="string", length=255)
     */
    private $pbxRetour;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_hash", type="string", length=255)
     */
    private $pbxHash;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pbx_time", type="datetime")
     */
    private $pbxTime;

    /**
     * @var string
     *
     * @ORM\Column(name="pbx_hmax", type="string", length=255)
     */
    private $pbxHmax;


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
     * Set pbxSite
     *
     * @param string $pbxSite
     * @return ParamPaiement
     */
    public function setPbxSite($pbxSite)
    {
        $this->pbxSite = $pbxSite;

        return $this;
    }

    /**
     * Get pbxSite
     *
     * @return string 
     */
    public function getPbxSite()
    {
        return $this->pbxSite;
    }

    /**
     * Set pbxRang
     *
     * @param string $pbxRang
     * @return ParamPaiement
     */
    public function setPbxRang($pbxRang)
    {
        $this->pbxRang = $pbxRang;

        return $this;
    }

    /**
     * Get pbxRang
     *
     * @return string 
     */
    public function getPbxRang()
    {
        return $this->pbxRang;
    }

    /**
     * Set pbxIdentifiant
     *
     * @param string $pbxIdentifiant
     * @return ParamPaiement
     */
    public function setPbxIdentifiant($pbxIdentifiant)
    {
        $this->pbxIdentifiant = $pbxIdentifiant;

        return $this;
    }

    /**
     * Get pbxIdentifiant
     *
     * @return string 
     */
    public function getPbxIdentifiant()
    {
        return $this->pbxIdentifiant;
    }

    /**
     * Set pbxCmd
     *
     * @param string $pbxCmd
     * @return ParamPaiement
     */
    public function setPbxCmd($pbxCmd)
    {
        $this->pbxCmd = $pbxCmd;

        return $this;
    }

    /**
     * Get pbxCmd
     *
     * @return string 
     */
    public function getPbxCmd()
    {
        return $this->pbxCmd;
    }

    /**
     * Set pbxPorteur
     *
     * @param string $pbxPorteur
     * @return ParamPaiement
     */
    public function setPbxPorteur($pbxPorteur)
    {
        $this->pbxPorteur = $pbxPorteur;

        return $this;
    }

    /**
     * Get pbxPorteur
     *
     * @return string 
     */
    public function getPbxPorteur()
    {
        return $this->pbxPorteur;
    }

    /**
     * Set $pbxTotal
     *
     * @param integer $pbxTotal
     * @return ParamPaiement
     */
    public function setPbxTotal($pbxTotal)
    {
        $this->$pbxTotal = $pbxTotal;

        return $this;
    }

    /**
     * Get $pbxTotal
     *
     * @return integer 
     */
    public function getPbxTotal()
    {
        return $this->pbxTotal;
    }

    /**
     * Set pbxDevise
     *
     * @param integer $pbxDevise
     * @return ParamPaiement
     */
    public function setPbxDevise($pbxDevise)
    {
        $this->pbxDevise = $pbxDevise;

        return $this;
    }

    /**
     * Get pbxDevise
     *
     * @return integer 
     */
    public function getPbxDevise()
    {
        return $this->pbxDevise;
    }

    /**
     * Set pbxEffectue
     *
     * @param string $pbxEffectue
     * @return ParamPaiement
     */
    public function setPbxEffectue($pbxEffectue)
    {
        $this->pbxEffectue = $pbxEffectue;

        return $this;
    }

    /**
     * Get pbxEffectue
     *
     * @return string 
     */
    public function getPbxEffectue()
    {
        return $this->pbxEffectue;
    }

    /**
     * Set pbxAnnule
     *
     * @param string $pbxAnnule
     * @return ParamPaiement
     */
    public function setPbxAnnule($pbxAnnule)
    {
        $this->pbxAnnule = $pbxAnnule;

        return $this;
    }

    /**
     * Get pbxAnnule
     *
     * @return string 
     */
    public function getPbxAnnule()
    {
        return $this->pbxAnnule;
    }

    /**
     * Set pbxRefuse
     *
     * @param string $pbxRefuse
     * @return ParamPaiement
     */
    public function setPbxRefuse($pbxRefuse)
    {
        $this->pbxRefuse = $pbxRefuse;

        return $this;
    }

    /**
     * Get pbxRefuse
     *
     * @return string 
     */
    public function getPbxRefuse()
    {
        return $this->pbxRefuse;
    }

    /**
     * Set pbxRepondreA
     *
     * @param string $pbxRepondreA
     * @return ParamPaiement
     */
    public function setPbxRepondreA($pbxRepondreA)
    {
        $this->pbxRepondreA = $pbxRepondreA;

        return $this;
    }

    /**
     * Get pbxRepondreA
     *
     * @return string 
     */
    public function getPbxRepondreA()
    {
        return $this->pbxRepondreA;
    }

    /**
     * Set pbxRetour
     *
     * @param string $pbxRetour
     * @return ParamPaiement
     */
    public function setPbxRetour($pbxRetour)
    {
        $this->pbxRetour = $pbxRetour;

        return $this;
    }

    /**
     * Get pbxRetour
     *
     * @return string 
     */
    public function getPbxRetour()
    {
        return $this->pbxRetour;
    }

    /**
     * Set pbxHash
     *
     * @param string $pbxHash
     * @return ParamPaiement
     */
    public function setPbxHash($pbxHash)
    {
        $this->pbxHash = $pbxHash;

        return $this;
    }

    /**
     * Get pbxHash
     *
     * @return string 
     */
    public function getPbxHash()
    {
        return $this->pbxHash;
    }

    /**
     * Set pbxTime
     *
     * @param \DateTime $pbxTime
     * @return ParamPaiement
     */
    public function setPbxTime($pbxTime)
    {
        $this->pbxTime = $pbxTime;

        return $this;
    }

    /**
     * Get pbxTime
     *
     * @return \DateTime 
     */
    public function getPbxTime()
    {
        return $this->pbxTime;
    }

    /**
     * Set pbxHmax
     *
     * @param string $pbxHmax
     * @return ParamPaiement
     */
    public function setPbxHmax($pbxHmax)
    {
        $this->pbxHmax = $pbxHmax;

        return $this;
    }

    /**
     * Get pbxHmax
     *
     * @return string 
     */
    public function getPbxHmax()
    {
        return $this->pbxHmax;
    }
}
