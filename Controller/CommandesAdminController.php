<?php

namespace fidi\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use fidi\EcommerceBundle\Entity\Commandes;
use fidi\EcommerceBundle\Form\CommandesType;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Column\ActionsColumn;

class CommandesAdminController extends Controller {

    public function commandesAction() {
        $em = $this->getDoctrine()->getManager();
        $fcommandes = $em->getRepository('fidiEcommerceBundle:Commandes')->findAll();
        $commandes = $this->get('knp_paginator')->paginate($fcommandes, $this->get('request')->query->get('page', 1), 7);
        //$delete_form = $this->createDeleteForm($id);
        return $this->render('fidiEcommerceBundle:Administration:Commandes/layout/index.html.twig', array('commandes' => $commandes));
    }

    public function showFactureAction($id) {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('fidiEcommerceBundle:Commandes')->find($id);

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('adminCommande'));
        }

        $this->container->get('setNewFacture')->facture($facture);
    }

    public function gridCommandeAction() {
        $source = new Entity("fidiEcommerceBundle:Commandes");
        $grid = $this->get('grid');
        $grid->setsource($source);
        // Create an Actions Column
        // Create an Actions Column
        $actionsColumn = new ActionsColumn('info_column_1', 'Actions');
        //$actionsColumn->setSeparator("<br />");
        $grid->addColumn($actionsColumn, 8);

        $rowAction1 = new RowAction('Voir détail', 'adminShowFacture');
        $rowAction1->setColumn('info_column_1');

        $rowAction2 = new RowAction('Supprimer', 'adminShowFacture');
        $rowAction2->setColumn('info_column_1');
        $grid->addRowAction($rowAction1);
        $grid->setLimits(array(10, 15, 20, 25));
        $grid->setDefaultLimit(10);
        $grid->setDefaultOrder('id', 'desc');
        return $grid->getGridResponse('fidiEcommerceBundle:Administration:Commandes/layout/gridCommande.html.twig');
    }

    public function commandeHierAction() {
        $em = $this->getDoctrine()->getManager();
        $fcommhier = $em->getRepository('fidiEcommerceBundle:Commandes')->byDate();
        $commhier = $this->get('knp_paginator')->paginate($fcommhier, $this->get('request')->query->get('page', 1), 10);
        return $this->render('fidiEcommerceBundle:Administration:Commandes/layout/commandeHier.html.twig', array('factures' => $commhier));
    }

    public function validerCommandeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('fidiEcommerceBundle:Commandes')->validerCommande($id);
        return $this->redirect($this->generateUrl('adminCommande'));
    }

    public function supprimerCommande2Action(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $com = $em->getRepository('fidiEcommerceBundle:Commandes')->find($id);
        if (!$com) {
            throw $this->createNotFoundException(
                    'Pas de commande trouvée ' . $id
            );
        }

        $form = $this->createFormBuilder($com)
                ->add('delete', 'submit')
                ->getForm();

        $form->handleRequest($request);
//print_r($com);exit();
        if ($form->isValid()) {
            $em->remove($com);
            $em->flush();
            return $this->redirect($this->generateUrl('adminCommande'));
        }

        return $this->redirect($this->generateUrl('adminCommande'));
    }

    public function supprimerCommandeAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('fidiEcommerceBundle:Commandes')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Entité non trouvée.');
            }
            //print_r($entity);exit;
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Commande supprimée avec succès');
        }
        return $this->redirect($this->generateUrl('adminCommande'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('adminSupprimerCommande', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Commandes')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité non trouvée..');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Commandes mis à jour avec succès');
            return $this->redirect($this->generateUrl('adminCommandes'));
        }
        return $this->render('fidiEcommerceBundle:Administration:Commandes/layout/delete.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createEditForm(Commandes $entity) {
        $form = $this->createForm(new CommandesType(), $entity);
        return $form;
    }

}
