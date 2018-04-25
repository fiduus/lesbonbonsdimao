<?php

namespace fidi\EcommerceBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fidi\EcommerceBundle\Entity\Produits;
use fidi\EcommerceBundle\Form\ProduitsType;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Column\JoinColumn;
/**
 * Produits controller.
 *
 */
class ProduitsAdminController extends Controller
{
   /**
     * Lists all Produits entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $findentities = $em->getRepository('fidiEcommerceBundle:Produits')->findAll();
        $entities = $this->get('knp_paginator')->paginate($findentities,$this->get('request')->query->get('page', 1),7);
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/index.html.twig', array(
            'entities' => $entities
        ));
    }
    /**
     * Creates a new Produits entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Produits();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Produit ajouté avec succès');
            return $this->redirect($this->generateUrl('adminProduits_show', array('id' => $entity->getId())));
        }
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
    * Creates a form to create a Produits entity.
    *
    * @param Produits $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Produits $entity)
    {
        $form = $this->createForm(new ProduitsType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Créer'));
        return $form;        
       
    }
    /**
     * Displays a form to create a new Produits entity.
     *
     */
    public function newAction()
    {
        $entity = new Produits();
        $form   = $this->createCreateForm($entity);
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Produits entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Produits')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité non trouvée.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),));
    }
    /**
     * Displays a form to edit an existing Produits entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Produits')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité non trouvée.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
    * Creates a form to edit a Produits entity.
    *
    * @param Produits $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Produits $entity)
    {
        $form = $this->createForm(new ProduitsType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Mettre à jour'));
        return $form;
    }
    /**
     * Edits an existing Produits entity.
     *
     */
    public function updateAction(Request $request, $id)
      {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('fidiEcommerceBundle:Produits')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Entité non trouvée..');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Produit mis à jour avec succès');
            return $this->redirect($this->generateUrl('adminProduits'));
        }
        return $this->render('fidiEcommerceBundle:Administration:Produits/layout/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Produits entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('fidiEcommerceBundle:Produits')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Entité non trouvée.');
            }
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success','Produit supprimé avec succès');
        }
        return $this->redirect($this->generateUrl('adminProduits'));
    }
    /**
     * Creates a form to delete a Produits entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminProduits_delete', array('id' => $id)))
            ->setMethod('DELETE')          
            ->getForm()
        ;
    }
    
    public function gridProduitAction()
    {
       $source = new Entity("fidiEcommerceBundle:Produits");
       $grid = $this->get('grid');
       //$this->get('knp_paginator')->paginate($source,$this->get('request')->query->get('page', 1),9);
       $grid->setsource($source);
       // Create an Actions Column
       // Create an Actions Column
       //$column = new JoinColumn(array('id' => 'my_join_column', 'title' => 'Catégorie', 'columns' => array('lastname', 'firstname')));
       //$grid->addColumn($column,3);
       
       $actionsColumn = new ActionsColumn('info_column_1', 'Actions');
       //$actionsColumn->setSeparator("<br />");
       $grid->addColumn($actionsColumn, 8);
       
       $rowAction1 = new RowAction('Afficher', 'adminProduits_show');
       $rowAction1->setColumn('info_column_1');
       
       $rowAction2 = new RowAction('Supprimer','adminProduits_delete');
       $rowAction2->setColumn('info_column_1');
       
       $rowAction3 = new RowAction('Editer','adminProduits_edit');
       $rowAction3->setColumn('info_column_1');
       
       $grid->addRowAction($rowAction1);
       $grid->addRowAction($rowAction2);
       $grid->addRowAction($rowAction3);   
       
       $grid->setLimits(array(10,15,20,25));
       $grid->setDefaultLimit(10);       
             
       return $grid->getGridResponse('fidiEcommerceBundle:Administration:Produits/layout/gridProduit.html.twig');
    }
}