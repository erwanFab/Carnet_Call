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
		    
			/*
			 * 
			 * 
			 * 
			 * 
			 * 
			 * 
			 * indexAction permettra de récupérer la List Global du
			 * Carnet d'adresse 
			 * L'avatar est représenté par picture-name inscrite sur Table : Avatar 
			 * on récupére le nom afin de visualiser l'image qui est stocké dans 'uploads/pictrures'
			 * 
			 * La Catégorie permettra par la suite plus facilement d'obtenir la liste des contacts par groupe
			 * tel que Amis, Famille, Médecin
			 * 
			 * A l'aide du Bundle KnpPaginator, celui-ci nous permettra de placer 5 à 10 contacts par pages
			 * ce qui nous évitera de faire défiler trop longtemps la page.
			 * 
			 * 
			 */
			
			
		public function indexAction(Request $request)
		{
		
			$em    = $this->get('doctrine.orm.entity_manager');
			
			$dql = "Select A.id_personne,Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
			FROM LoginLoginBundle:Carnet AS A
			INNER JOIN LoginLoginBundle:Categories  As Ca
			WITH A.id_cat = Ca.id
			INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id ";
			
			$query = $em->createQuery($dql);
			
		    
		    
		    
		    $paginator  = $this->get('knp_paginator');
		    $pagination = $paginator->paginate(
		        $query, /* query NOT result */
		    	$request->query->getInt('page', 1)/*page number*/,
		        5
		    		
		        /*limit per page*/
		    );
			
		    // parameters to template
		    return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
		}
		        
		     /*
		      * Selection par Amis
		      * 
		      * Même code que indexAction en rajoutant 
		      * l'element WHERE id_cat = 1 afin de récupérer les Amis
		      * 
		      * 
		      */   
		        
		public function friendsAction(Request $request)
		{
		
			$em    = $this->get('doctrine.orm.entity_manager');
		
			$dql = "Select A.id_personne, Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
					FROM LoginLoginBundle:Carnet AS A
					INNER JOIN LoginLoginBundle:Categories  As Ca
					WITH A.id_cat = Ca.id
					INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id 
					WHERE A.id_cat =1";
		
			$query = $em->createQuery($dql);
		
		
		
		
			$paginator  = $this->get('knp_paginator');
			$pagination = $paginator->paginate(
					$query, /* query NOT result */
					$request->query->getInt('page', 1)/*page number*/,
					5
		
					/*limit per page*/
					);
		
			// parameters to template
			return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
		}
		       

			/*
			 * Selection par Famille
			 *
			 * Même code que indexAction en rajoutant
			 * l'element WHERE id_cat = 1 afin de récupérer les Amis
			 *
			 *
			 */



		public function famillyAction(Request $request)
		{

				$em    = $this->get('doctrine.orm.entity_manager');
			
				$dql = "Select A.id_personne, Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
						FROM LoginLoginBundle:Carnet AS A
						INNER JOIN LoginLoginBundle:Categories  As Ca
						WITH A.id_cat = Ca.id
						INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id
						WHERE A.id_cat =2";
			
				$query = $em->createQuery($dql);
			
			
			
			
				$paginator  = $this->get('knp_paginator');
				$pagination = $paginator->paginate(
						$query, /* query NOT result */
						$request->query->getInt('page', 1)/*page number*/,
						5
			
						/*limit per page*/
						);
			
				// parameters to template
				return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
			}
 
			
				/*
				 * Selection par Médecin Généraliste et Spécialiste
				 *
				 * Même code que indexAction en rajoutant
				 * l'element WHERE id_cat = 3 AND id_cat =4 afin de récupérer les Amis
				 *
				 *
				 */
						
			
			
			
			
			
			

				public function doctorAction(Request $request)
				{
				
					$em    = $this->get('doctrine.orm.entity_manager');
				
					$dql = "Select A.id_personne,Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
							FROM LoginLoginBundle:Carnet AS A
							INNER JOIN LoginLoginBundle:Categories  As Ca
							WITH A.id_cat = Ca.id
							INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id
							WHERE A.id_cat = 3
							OR A.id_cat= 4";
				
					$query = $em->createQuery($dql);
				
				
				
				
					$paginator  = $this->get('knp_paginator');
					$pagination = $paginator->paginate(
							$query, /* query NOT result */
							$request->query->getInt('page', 1)/*page number*/,
							5
				
							/*limit per page*/
							);
					
					// parameters to template
					return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
					
					
					
					
					
					
				}

  
				/*
				 * Selection par Médecin et PMI
				 *
				 * Même code que indexAction en rajoutant
				 * l'element WHERE id_cat = 3 OR id_cat =4 afin de récupérer les Amis
				 *
				 *
				 */
								
				
				public function pmiAction(Request $request)
				{
				
					$em    = $this->get('doctrine.orm.entity_manager');
				
					$dql = "Select A.id_personne, Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
							FROM LoginLoginBundle:Carnet AS A
							INNER JOIN LoginLoginBundle:Categories  As Ca
							WITH A.id_cat = Ca.id
							INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id
							WHERE A.id_cat = 5
							";
				
					$query = $em->createQuery($dql);
				
				
				
				
					$paginator  = $this->get('knp_paginator');
					$pagination = $paginator->paginate(
							$query, /* query NOT result */
							$request->query->getInt('page', 1)/*page number*/,
							5
				
							/*limit per page*/
							);
				
					// parameters to template
					return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
				}
				
				
				/*
				 * Selection par Garage - Auto
				 *
				 * Même code que indexAction en rajoutant
				 * l'element WHERE id_cat = 7 afin de récupérer les contacts pour l'auto 
				 *
				 *
				 */
				
								
					
				
				public function autoAction(Request $request)
				{
				
					$em    = $this->get('doctrine.orm.entity_manager');
				
					$dql = "Select A.id_personne, Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
							FROM LoginLoginBundle:Carnet AS A
							INNER JOIN LoginLoginBundle:Categories  As Ca
							WITH A.id_cat = Ca.id
							INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id
							WHERE A.id_cat = 7
							";
				
					$query = $em->createQuery($dql);
				
				
				
				
					$paginator  = $this->get('knp_paginator');
					$pagination = $paginator->paginate(
							$query, /* query NOT result */
							$request->query->getInt('page', 1)/*page number*/,
							5
				
							/*limit per page*/
							);
				
					// parameters to template
					return $this->render('LoginLoginBundle:Carnet:Carnet.html.twig', array('pagination' => $pagination));
				}
				
				
				
				
				
				/*
				 * Selection par Logement
				 *
				 * Même code que indexAction en rajoutant
				 * l'element WHERE id_cat = 6 afin de récupérer les contact pour l'auto
				 *
				 *
				 */
				
				
					
				
				public function houseAction(Request $request)
				{
				
					$em    = $this->get('doctrine.orm.entity_manager');
				
					$dql = "Select A.id_personne, Av.picture_name,A.nom,A.prenom,Ca.nom_categorie
							FROM LoginLoginBundle:Carnet AS A
							INNER JOIN LoginLoginBundle:Categories  As Ca
							WITH A.id_cat = Ca.id
							INNER JOIN LoginLoginBundle:Avatar  As Av WITH  A.image_id=Av.id
							WHERE A.id_cat = 6
							";
				
					$query = $em->createQuery($dql);
				
				
				
				
					$paginator  = $this->get('knp_paginator');
					$pagination = $paginator->paginate(
							$query, /* query NOT result */
							$request->query->getInt('page', 1)/*page number*/,
							5
				
							/*limit per page*/
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
