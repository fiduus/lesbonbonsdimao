<?php


namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of EvenementsType
 *
 * @author fidi
 */
class EvenementsType extends AbstractType{
       /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,array('required'=>false))
            ->add('date','text',array('required'=>false))
            ->add('cp','text',array('required'=>false))
            ->add('ville','text',array('required'=>false));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fidi\EcommerceBundle\Entity\Evenements'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'ecommerce_ecommercebundle_evenements';
    }
}
