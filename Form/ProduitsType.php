<?php

namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use fidi\EcommerceBundle\Form\MediaType;

class ProduitsType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array('required'=>false))
            ->add('nom2','text',array('required'=>false))
            ->add('poids','text',array('required'=>false))
            ->add('valnut','textarea',array('required'=>false))
            ->add('vertu','textarea',array('required'=>false))
            ->add('composition','textarea',array('required'=>false))
            ->add('description','textarea',array('required'=>false))            
            ->add('prix', 'money',array('required'=>false))           
            ->add('image', new MediaType())
            ->add('imageDescription', new MediaDescrType())
            ->add('categorie')
            ->add('stock','integer',array('required'=>false))
            ->add('tva')           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fidi\EcommerceBundle\Entity\Produits'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_produits';
    }
}
?>
