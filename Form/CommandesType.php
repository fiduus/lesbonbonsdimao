<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of CommandesType
 *
 * @author fidi
 */
class CommandesType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',null,array('required'=>false))
            //->add('date','text',array('required'=>false))
            ->add('reference','text',array('required'=>false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fidi\EcommerceBundle\Entity\Commandes'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_commandes';
    }//put your code here
}
