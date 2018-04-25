<?php

namespace fidi\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use fidi\EcommerceBundle\Entity\UtilisateursAdresses;
use fidi\EcommerceBundle\Entity\Commandes;
use fidi\EcommerceBundle\Entity\Produits;

class CommandesController extends Controller
{
    public function facture()
    {
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.secure_random');
        $session = $this->getRequest()->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTVA = 0;
        $poids = 0;
        $poidsTotal = 0;
        $fraisPort = 0;
        
        $facturation = $em->getRepository('fidiEcommerceBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('fidiEcommerceBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $produits = $em->getRepository('fidiEcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));
        
        foreach($produits as $produit)
        {
            $prixHT = ($produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = $prixHT;
            $totalHT += $prixHT;
            
           /*if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
                $commande['tva']['%'.$produit->getTva()->getValeur()] = round($prixTTC - $prixHT,2);
            else
                $commande['tva']['%'.$produit->getTva()->getValeur()] += round($prixTTC - $prixHT,2);*/
            
            //$totalTVA += round($prixTTC - $prixHT,2);
            $poids = ($produit->getPoids() * $panier[$produit->getId()]);
            $poidsTotal = $poidsTotal + $poids;
            $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
                                                            'quantite' => $panier[$produit->getId()],
                                                            'poids'=> $produit->getPoids(),
                                                            'poidsTotal'=> $poidsTotal,
                                                            'prixHT' => round($produit->getPrix(),2),
                                                            'prixTTC' => round($produit->getPrix(),2));
        }  
        
        $commande['livraison'] = array('prenom' => $livraison->getPrenom(),
                                    'nom' => $livraison->getNom(),
                                    'telephone' => $livraison->getTelephone(),
                                    'adresse' => $livraison->getAdresse(),
                                    'cp' => $livraison->getCp(),
                                    'ville' => $livraison->getVille(),
                                    'pays' => $livraison->getPays(),
                                    'complement' => $livraison->getComplement());
        $commande['facturation'] = array('prenom' => $facturation->getPrenom(),
                                    'nom' => $facturation->getNom(),
                                    'telephone' => $facturation->getTelephone(),
                                    'adresse' => $facturation->getAdresse(),
                                    'cp' => $facturation->getCp(),
                                    'ville' => $facturation->getVille(),
                                    'pays' => $facturation->getPays(),
                                    'complement' => $facturation->getComplement());
        $commande['prixHT'] = round($totalHT,2);
        if ($poidsTotal <= 250){$fraisPort = 0.25;}
        if ($poidsTotal > 250 && $poidsTotal <= 500){$fraisPort = 6.10;}
        if ($poidsTotal > 500 && $poidsTotal <= 750){$fraisPort = 6.90;}
        if ($poidsTotal > 750 && $poidsTotal <= 1000){$fraisPort = 7.50;}
        if ($poidsTotal > 1000 && $poidsTotal <= 2000){$fraisPort = 8.50;}
        if ($poidsTotal > 2000 && $poidsTotal <= 5000){$fraisPort = 12.90;}
        $commande['fraisPort'] = $fraisPort;       
        $commande['poidsTotal'] = $poidsTotal;
        $commande['prixTTC'] = round($totalHT + $fraisPort,2);
        $commande['token'] = bin2hex($generator->nextBytes(20));
       // print_r($commande);exit;
        return $commande;
    }
    
    public function prepareCommandeAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if (!$session->has('commande'))
           {$commande = new Commandes();}
        else
           {$commande = $em->getRepository('fidiEcommerceBundle:Commandes')->find($session->get('commande'));}
        
        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());
        
        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande',$commande);
        }
        
        $em->flush();
        
        return new Response($commande->getId());
    }
    
    public function prepareCommande2Action()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('fidiEcommerceBundle:Commandes')->find($session->get('commande'));
        
        $commande->setDate(new \DateTime());       
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());
        
        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande',$commande);
        }
        
        $em->flush();
        
        return new Response($commande->getId());
    }
    
    /*
     * Cette methode remplace l'api banque.
     */
    public function validationCommandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('fidiEcommerceBundle:Commandes')->find($id);
        
        if (!$commande)
        {
            throw $this->createNotFoundException('La commande n\'existe pas');
        }
        $commande->setValider(0);
        $commande->setReference($this->container->get('setNewReference')->reference()); //Service
        $em->flush();   
        
        $session = $this->getRequest()->getSession();
      /*  $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');*/
        
        $this->get('session')->getFlashBag()->add('success','Votre commande est validée avec succès');
        //return $this->redirect($this->generateUrl('paiement'));
        //return $this->redirect($this->generateUrl('facturesPDF'));
         $session = $this->getRequest()->getSession();
       // $em = $this->getDoctrine()->getManager();
        $commande = $session->get('commande');
        $com = $commande->getCommande();
      
        //var_dump($com['prixTTC']);exit;
        $paybox = $this->get('lexik_paybox.request_handler');
        $paybox->setParameters(array(
            'PBX_CMD'          => 'CMD'.time(),
            'PBX_DEVISE'       => '978',
            'PBX_PORTEUR'      => $commande->getUtilisateur()->getEmail(),
            //'PBX_PORTEUR'      => 'test@test.fr',
            'PBX_RETOUR'       => 'Mt:M;Ref:R;Auto:A;Erreur:E',
            'PBX_TOTAL'        => $com['prixTTC']*100, 
           // 'PBX_TOTAL'        => '1000', 
           // 'PBX_TYPEPAIEMENT' => 'CARTE',
           // 'PBX_TYPECARTE'    => 'CB',
            'PBX_EFFECTUE'     => $this->generateUrl('lexik_paybox_sample_return', array('status' => 'success'), true),
            'PBX_REFUSE'       => $this->generateUrl('lexik_paybox_sample_return', array('status' => 'denied'), true),
            'PBX_ANNULE'       => $this->generateUrl('lexik_paybox_sample_return', array('status' => 'canceled'), true),
            'PBX_RUF1'         => 'POST',
            'PBX_REPONDRE_A'   => $this->generateUrl('lexik_paybox_ipn', array('time' => time()), true),
        ));
       /* $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');*/
        return $this->render(
            'fidiEcommerceBundle:Paiement/Sample:index.html.twig',
            array(
                'url'  => 'https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi',
                'form' => $paybox->getForm()->createView(),
            )
        );
    }
    
}
