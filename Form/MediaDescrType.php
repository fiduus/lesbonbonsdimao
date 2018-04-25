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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
/**
 * Description of MediaDescrType
 *
 * @author fidi
 */
class MediaDescrType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('file','file', array('required' => false,'label'=>false))
           ->add('name','hidden' ,array('required' => false));         
    }    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fidi\EcommerceBundle\Entity\MediaDescr'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_mediaDescr';
    }
}
