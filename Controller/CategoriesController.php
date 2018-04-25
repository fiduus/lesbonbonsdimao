<?php
namespace fidi\EcommerceBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('fidiEcommerceBundle:Categories')->findAll();
        
        return $this->render('fidiEcommerceBundle:Default:categories/modulesUsed/menu.html.twig', array('categories' => $categories));
    }
}


