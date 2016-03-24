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
		
		/*
		 * 	On parcourt la base de complement affin de retrouver les information concernant 
		 * 	la personne que l'on souhaite obtenir
		 *  
		 * 	$request->attributes->get(' ') permet de retouver dans l'url ce que nous avons besoin 
		 * 	pour retrouver les info en fonction de l'id de la personne
		 * 
		 * 	pour ce qui est du soucis en ce qui concerne l'affichage des N° de téléphone 
		 *  car une serie de 10 chiffres est stocker dans la base 
		 *  mais pour une meilleur visibilité on va séparer par un espace ou un blanc
		 *   tout les 2 chiffres
		 *   
		 *    par ex chunk_split($cpl['tel_fixe'],2,' ');
		 * 
		 * 	
		 */
		
		
		
		
		$id = $request->attributes->get('id');
		
		$nom =	$request->attributes->get('nom');
		$prenom = $request->attributes->get('prenom');
		

		$em    = $this->get('doctrine.orm.entity_manager');
			
		$dql = "Select Cpl.id,Ca.nom,Cpl.adresse,Cpl.email,Cpl.tel_fixe,Cpl.tel_box,Cpl.mobile
			FROM LoginLoginBundle:Complement AS Cpl
			INNER JOIN LoginLoginBundle:Carnet  As Ca
			WITH Ca.id_personne = Cpl.personne
			WHERE Cpl.id = ".$id;
			
		$query = $em->createQuery($dql);
			
		$complement = $query->getResult();
		
		
		
		
		
		
		foreach ($complement as $cpl){
			
			 $affiche1 = chunk_split($cpl['tel_fixe'],2,' ');
			 $affiche2 = chunk_split($cpl['tel_box'],2,' ');
			 $affiche3 = chunk_split($cpl['mobile'],2,' ');
		}
		
		
		// parameters to template
		return $this->render('LoginLoginBundle:Carnet:Complement.html.twig',
				array(
						'id'=>$id, 
						'nom'=>$nom , 
						'prenom'=>$prenom ,
						'affiche1'=>$affiche1,
						'affiche2'=>$affiche2,
						'affiche3'=>$affiche3,						
						'complement'=>$complement
						
				));
		
	}
	
	
}