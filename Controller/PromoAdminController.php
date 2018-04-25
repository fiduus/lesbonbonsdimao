<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace fidi\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fidi\EcommerceBundle\Entity\Promo;
use fidi\EcommerceBundle\Form\PromoType;
use Symfony\Component\HttpFoundation\Request;
/**
 * Description of PromoAdminController
 *
 * @author fidi
 */
class PromoAdminController extends Controller {
    //put your code here /**
    /* Lists all Promo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('fidiEcommerceBundle:Promo')->findAll();
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Promo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Promo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('adminPromo_show', array('id' => $entity->getId())));
        }
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
    * Creates a form to create a Promo entity.
    *
    * @param Promo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Promo $entity)
    {
        $form = $this->createForm(new PromoType(), $entity, array(
            'action' => $this->generateUrl('adminPromo_create'),
            'method' => 'POST',
        ));        
        return $form;
    }
    /**
     * Displays a form to create a new Promo entity.
     *
     */
    public function newAction()
    {
        $entity = new Promo();
        $form   = $this->createCreateForm($entity);
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Promo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Promo')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité évènement non trouvée.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }
    /**
     * Displays a form to edit an existing Categories entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Promo')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité évènement non trouvée.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
    * Creates a form to edit a Promo entity.
    *
    * @param Promo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Promo $entity)
    {
        $form = $this->createForm(new PromoType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Mettre à jour'));
        return $form;
    }
    /**
     * Edits an existing Categories entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Promo')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité Promo non trouvée.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
         if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Promo mis à jour avec succès');
            return $this->redirect($this->generateUrl('adminPromo'));
        }
        return $this->render('fidiEcommerceBundle:Administration:Promo/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categories entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('fidiEcommerceBundle:Promo')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Promo non trouvée.');
            }
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('adminPromo'));
    }
    /**
     * Creates a form to delete a Categories entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPromo_delete', array('id' => $id)))
            ->setMethod('DELETE')            
            ->getForm()
        ;
    }
}
