<?php


namespace fidi\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fidi\EcommerceBundle\Form\PaiementType;
use fidi\EcommerceBundle\Entity\ParamPaiement;
/**
 * Description of PaiementController
 *
 * @author fidi
 */
class PaiementController extends Controller{
    /**
     * Index action creates the form for a payment call.
     *
     * @return Response
     */
    
   
    public function returnAction(Request $request, $status)
    {
        return $this->render('LexikPayboxBundle:Paiement:Sample:return.html.twig', array(
            'status'     => $status,
            'parameters' => $request->query,
        ));
    }
    
    public function refuseAction()
    {
        $session = $this->getRequest()->getSession();
        $commande = $session->get('commande');
        
        return $this->render(
            'fidiEcommerceBundle:Paiement:Sample/index.html.twig');
    }
    
    public function accepteAction()
    {
         return $this->render(
            'fidiEcommerceBundle:Paiement:Sample/accepte.html.twig');
    }
    
    public function annuleAction()
    {
         return $this->render(
            'fidiEcommerceBundle:Paiement:Sample/annule.html.twig');
    }
    
    public function ipnAction()
    {
        $payboxResponse = $this->container->get('lexik_paybox.response_handler');
        $result = $payboxResponse->verifySignature();

        return new Response($result ? 'OK' : 'KO');
    }
    
    public function indexAction()
    {      
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
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');
        return $this->render(
            'LexikPayboxBundle:Sample:index.html.twig',
            array(
                'url'  => 'https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi',
                'form' => $paybox->getForm()->createView(),
            )
        );
    }

}
