<?php
namespace Login\LoginBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Login\LoginBundle\Entity\Carnet;





/**
 * Complement controller.
 *
 */
class ComplementController extends Controller
{
	public  function indexAction(Request $request)
	{
		
		
		$id = $request->attributes->get('id');
		
		$nom =	$request->attributes->get('nom');
		$prenom = $request->attributes->get('prenom');
		

		$em    = $this->get('doctrine.orm.entity_manager');
			
		$dql = "Select Ca.nom,Cpl.adresse,Cpl.email,Cpl.tel_fixe,Cpl.tel_box,Cpl.mobile
			FROM LoginLoginBundle:Complement AS Cpl
			INNER JOIN LoginLoginBundle:Carnet  As Ca
			WITH Ca.id_personne = Cpl.personne
			WHERE Cpl.id = ".$id;
			
		$query = $em->createQuery($dql);
			
		$complement = $query->getResult();
		
	
		
		
		// parameters to template
		return $this->render('LoginLoginBundle:Carnet:Complement.html.twig',array('nom'=>$nom , 'prenom'=>$prenom ,'complement'=>$complement));
		
	}
	
	
}