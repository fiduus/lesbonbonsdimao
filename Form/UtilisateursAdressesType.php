<?php

namespace fidi\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UtilisateursAdressesType extends AbstractType {

  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
  private $em;

  public function __construct($em) {
    $this->em = $em;
    //var_dump($em);
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
        ->add('id')
        ->add('nom')
        ->add('prenom')
        ->add('telephone')
        ->add('adresse', 'textarea')
        ->add('cp', null, array('attr' => array('class' => 'cp',
                                                'maxlength' => 5)))
        ->add('ville', 'choice', array('attr' => array('class' => 'ville')))
        ->add('pays')
        ->add('complement', null, array('required' => false));
    //->add('utilisateur')
      $city = function(FormInterface $form, $cp){       
      //          
      $villeCodePostal = $this->em->getRepository('fidiUserBundle:VillesFranceFree')->findBy(array('villeCodePostal' => $cp));
      
      if ($villeCodePostal) {
        $villes = array();
        foreach ($villeCodePostal as $ville) {
        $villes[$ville->getVilleNom()] = $ville->getVilleNom();
        }
        }
        else {
        $ville = null;
        }
        $form->add('ville', 'choice', array('attr' => array('class' => 'ville'),
                                                            'choices' => $villes));
      };
      
      $builder->get('cp')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($city){
        $city($event->getForm()->getParent(),$event->getForm()->getData());
      });
  }

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'fidi\EcommerceBundle\Entity\UtilisateursAdresses'
    ));
  }

  /**
   * @return string
   */
  public function getName() {
    return 'ecommerce_ecommercebundle_utilisateursadresses';
  }

}

