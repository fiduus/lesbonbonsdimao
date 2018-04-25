<?php

namespace fidi\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fidi\EcommerceBundle\Form\RechercheType;
use fidi\EcommerceBundle\Entity\Categories;

class ProduitsController extends Controller
{  
    public function produitsAction(Categories $categorie = null)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if ($categorie != null)
            $findProduits = $em->getRepository('fidiEcommerceBundle:Produits')->byCategorie($categorie);
        else 
            $findProduits = $em->getRepository('fidiEcommerceBundle:Produits')->findAll();
        
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->get('request')->query->get('page', 1),9);
        
        return $this->render('fidiEcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                 'panier' => $panier));
    }
    
    public function presentationAction($id)
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('fidiEcommerceBundle:Produits')->find($id);
        
        if (!$produit) throw $this->createNotFoundException('La page n\'existe pas.');
        
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        
        return $this->render('fidiEcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit,
                                                                                                     'panier' => $panier));
    }
    
    public function rechercheAction() 
    {
        $form = $this->createForm(new RechercheType());
        return $this->render('fidiEcommerceBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));
    }
    
    public function rechercheTraitementAction() 
    {
        $form = $this->createForm(new RechercheType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('fidiEcommerceBundle:Produits')->recherche($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }
        
        return $this->render('fidiEcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }
}

?>
