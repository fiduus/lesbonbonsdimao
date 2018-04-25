<?php

namespace fidi\EcommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Description of FrontController
 *
 * @author FidiChristèle
 */
class FrontController extends Controller {
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('fidiEcommerceBundle:Produits')->findAll();
        return $this->render('fidiEcommerceBundle::Default/Front/front_detail.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    public function evenementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('fidiEcommerceBundle:Evenements')->findAll();
        $cat = $em->getRepository('fidiEcommerceBundle:Categories')->findAll();
        return $this->render('fidiEcommerceBundle::Default/Front/front_detail.html.twig', array(
            'entities' => $entities,'cat'=> $cat
        ));
    }
    
    public function cgvAction()
    {
         return $this->render('fidiEcommerceBundle::Default/Front/cgv.html.twig');
    }
    
    public function cookieAction()
    {
         return $this->render('fidiEcommerceBundle::Default/Front/cookie.html.twig');
    }
    
    public function mlAction()
    {
         return $this->render('fidiEcommerceBundle::Default/Front/ml.html.twig');
    }
}


