<?php

namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class MediaType extends AbstractType
{
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
            'data_class' => 'fidi\EcommerceBundle\Entity\Media'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_media';
    }
}
