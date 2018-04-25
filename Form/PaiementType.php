<?php

namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of PaiementType
 *
 * @author FidiChristèle
 */
class PaiementType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
   

        $builder
                //->add('PBX_PAYBOX', 'hidden', array('required' => false, 'mapped' => false, 'data' => 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi'))
                //->add('PBX_BACKUP1', 'hidden', array('required' => false, 'mapped' => false, 'data' => 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi'))
                //->add('PBX_BACKUP2', 'hidden', array('required' => false, 'mapped' => false, 'data' => 'https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi'))
                ->add('PBX_SITE', 'hidden', array('required' => false))
                ->add('PBX_RANG', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_IDENTIFIANT', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_TOTAL', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_DEVISE', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_CMD', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_PORTEUR', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_REPONDRE_A', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_RETOUR', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_EFFECTUE', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_ANNULE', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_REFUSE', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_HASH', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_TIME', 'hidden', array('required' => false, 'mapped' => false))
                ->add('PBX_HMAC', 'hidden', array('required' => false, 'mapped' => false))   
                ->add('Envoyer', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'fidi\EcommerceBundle\Entity\ParamPaiement'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ecommerce_ecommercebundle_paiement';
    }

}

?>
