<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace fidi\EcommerceBundle\Controller;

/**
 * Description of EssaiController
 *
 * @author fidi
 */
class EssaiController {
    public function index2Action()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();       
        
             // --------------- VARIABLES A MODIFIER ---------------
// Ennonciation de variables
        $pbx_site = '1765085';         //variable de test 1999888
        $pbx_rang = '01';         //variable de test 32
        $pbx_identifiant = '723697158'; 			            //variable de test 3
        $pbx_cmd = 'cmd_test1';								//variable de test cmd_test1
        $pbx_porteur = 'etest@test.fr';							//variable de test test@test.fr
        $pbx_total = '100';									//variable de test 100
// Suppression des points ou virgules dans le montant						
        $pbx_total = str_replace(",", "", $pbx_total);
        $pbx_total = str_replace(".", "", $pbx_total);

// Paramétrage des urls de redirection après paiement
        $pbx_effectue = 'http://localhost/bonbon/web/app_dev.php/paiement/accepte';
        $pbx_annule = 'http://localhost/bonbon/web/app_dev.php/paiement/annule';
        $pbx_refuse = 'http://localhost/bonbon/web/app_dev.php/paiement/refuse';
// Paramétrage de l'url de retour back office site
        $pbx_repondre_a = 'http://localhost/bonbon/web/app_dev.php/';
// Paramétrage du retour back office site
        $pbx_retour = 'Mt:M;Ref:R;Auto:A;Erreur:E';

// Connection à la base de données
// mysql_connect...
// On récupère la clé secrète HMAC (stockée dans une base de données par exemple) et que l’on renseigne dans la variable $keyTest;
        $keyTest = '7ac5a13ed5f64e38018c79d5c3d6755006d109361e14bd2e5cd5cf7461791cd8cb63c325d488babf7ea70bb8e336e14aac2fd4b1794017815fb6ae2a110251de';
//$keyTest = 'votre clé générée depuis le back office (admin.paybox.com)';
// --------------- TESTS DE DISPONIBILITE DES SERVEURS ---------------

        $serveurs = array('tpeweb.paybox.com', //serveur primaire
            'tpeweb1.paybox.com'); //serveur secondaire
        $serveurOK = "";
//phpinfo(); <== voir paybox
        foreach ($serveurs as $serveur) {
            $doc = new \DOMDocument();
            $doc->loadHTMLFile('https://' . $serveur . '/load.html');
            $server_status = "";
            $element = $doc->getElementById('server_status');
            if ($element) {
                $server_status = $element->textContent;
            }
            if ($server_status == "OK") {
// Le serveur est prêt et les services opérationnels
                $serveurOK = $serveur;
                break;
            }
// else : La machine est disponible mais les services ne le sont pas.
        }
//curl_close($ch); <== voir paybox
        if (!$serveurOK) {
            die("Erreur : Aucun serveur n'a été trouvé");
        }
// Activation de l'univers de préproduction
//$serveurOK = 'preprod-tpeweb.paybox.com';
//Création de l'url cgi paybox
        $serveurOK = 'https://' . $serveurOK . '/cgi/MYchoix_pagepaiement.cgi';
// echo $serveurOK;
// --------------- TRAITEMENT DES VARIABLES ---------------
// On récupère la date au format ISO-8601
        $dateTime = date("c");

// On crée la chaîne à hacher sans URLencodage
        $msg = "PBX_SITE=" . $pbx_site .
                "&PBX_RANG=" . $pbx_rang .
                "&PBX_IDENTIFIANT=" . $pbx_identifiant .
                "&PBX_TOTAL=" . $pbx_total .
                "&PBX_DEVISE=978" .
                "&PBX_CMD=" . $pbx_cmd .
                "&PBX_PORTEUR=" . $pbx_porteur .
                "&PBX_REPONDRE_A=" . $pbx_repondre_a .
                "&PBX_RETOUR=" . $pbx_retour .
                "&PBX_EFFECTUE=" . $pbx_effectue .
                "&PBX_ANNULE=" . $pbx_annule .
                "&PBX_REFUSE=" . $pbx_refuse .
                "&PBX_HASH=SHA512" .
                "&PBX_TIME=" . $dateTime;
// echo $msg;
// Si la clé est en ASCII, On la transforme en binaire
        $binKey = pack("H*", $keyTest);

// On calcule l’empreinte (à renseigner dans le paramètre PBX_HMAC) grâce à la fonction hash_hmac et //
// la clé binaire
// On envoi via la variable PBX_HASH l'algorithme de hachage qui a été utilisé (SHA512 dans ce cas)
// Pour afficher la liste des algorithmes disponibles sur votre environnement, décommentez la ligne //
// suivante
// print_r(hash_algos());
        $hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));
        $paramPaiement = new ParamPaiement();
        $paramPaiement->setPbxAnnule($pbx_annule);
        $paramPaiement->setPbxRefuse($pbx_refuse);
        $paramPaiement->setPbxCmd($pbx_cmd);
        $paramPaiement->setPbxDevise(978);
        $paramPaiement->setPbxEffectue($pbx_effectue);
        $paramPaiement->setPbxHash('SHA512');
        $paramPaiement->setPbxHmax($hmac);
        $paramPaiement->setPbxIdentifiant($pbx_identifiant);
        $paramPaiement->setPbxPorteur($pbx_porteur);
        $paramPaiement->setPbxRang($pbx_rang);
        $paramPaiement->setPbxRepondreA($pbx_repondre_a);
        $paramPaiement->setPbxRetour($pbx_retour);
        $paramPaiement->setPbxSite($pbx_site);
        $paramPaiement->setPbxTime($dateTime);
        $paramPaiement->setPbxTotal($pbx_total);
        
        $form = $this->createForm(new PaiementType(), $paramPaiement);
        //var_dump($paramPaiement);exit;
        return $this->render(
            'fidiEcommerceBundle:Paiement:Sample/index.html.twig',
            array(                
                'form' => $form->createView(),'serveurok'=>$serveurOK )            
        );
    }
}
