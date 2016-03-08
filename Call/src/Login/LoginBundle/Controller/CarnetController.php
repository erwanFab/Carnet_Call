<?php

namespace Login\LoginBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Login\LoginBundle\Entity\Categories;
use Login\LoginBundle\Entity\Carnet;



use Login\LoginBundle\Entity\Avatar;

/**
 * Carnet controller.
 *
 */
class CarnetController extends Controller
{
    
public function indexAction(Request $request)
{

	$em    = $this->get('doctrine.orm.entity_manager');
	
	$dql = "Select Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
	FROM LoginLoginBundle:Carnet AS A
	INNER JOIN LoginLoginBundle:Categories  As Ca
	WITH A.id_cat = Ca.id
	INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image=Av.id ";
	
	$query = $em->createQuery($dql);
	
    
    
    
    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
        $query, /* query NOT result */
    	$request->query->getInt('page', 1)/*page number*/,
        5/*limit per page*/
    );
	
    // parameters to template
    return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
}
        
        
        

       
    
    
  
    
    
    

   
    public function newAction(Request $request)
    {
        $carnet = new Carnet();
        $form = $this->createForm('Login\LoginBundle\Form\CarnetType', $carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carnet);
            $em->flush();

            return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('id' => $carnet->getId()));
        }

        return $this->render('LoginLoginBundle:Carnet:Carnetnew.html.twig', array(
            'carnet' => $carnet,
            'formCarnet' => $form->createView(),
        ));
    }

   
    public function showAction(Carnet $carnet)
    {
        $deleteForm = $this->createDeleteForm($carnet);

        return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array(
            'carnet' => $carnet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    
    public function editAction(Request $request, Carnet $carnet)
    {
        $deleteForm = $this->createDeleteForm($carnet);
        $editForm = $this->createForm('Login\LoginBundle\Form\CarnetType', $carnet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carnet);
            $em->flush();

            return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('id' => $carnet->getId()));
        }

        return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array(
            'carnet' => $carnet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

   
    public function deleteAction(Request $request, Carnet $carnet)
    {
        $form = $this->createDeleteForm($carnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carnet);
            $em->flush();
        }

        return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig');
    }

    /**
     * Creates a form to delete a Carnet entity.
     *
     * @param Carnet $carnet The Carnet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carnet $carnet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('login_login_carnet_delete', array('id' => $carnet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
