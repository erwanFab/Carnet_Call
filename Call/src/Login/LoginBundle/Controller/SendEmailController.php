<?php
namespace Login\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Login\LoginBundle\Entity\Carnet;
class SendEmailController extends Controller
{
	public  function showAction(Request $request)
	{
		
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
			
			
			
		// the above is a shortcut for this
		$user = $this->get('security.token_storage')->getToken()->getUser();
		
		
		if($user){
		
		 $EmailUser = $user ->getEmail();
		 
	
		
		$id=$request->get('id');
		
		
		
		$em    = $this->get('doctrine.orm.entity_manager');
			
		$dql = "Select Ca.prenom,Ca.nom,Cpl.adresse,Cpl.email,Cpl.tel_fixe,Cpl.tel_box,Cpl.mobile
			FROM LoginLoginBundle:Complement AS Cpl
			INNER JOIN LoginLoginBundle:Carnet  As Ca
			WITH Ca.id_personne = Cpl.personne
			WHERE Cpl.id = ".$id;
			
		$query = $em->createQuery($dql);
			
		$complement = $query->getResult();
		
		foreach ($complement as $cpl){
			$nom = $cpl['nom'];
			$prenom = $cpl['prenom'];
			
			$adresse= $cpl['adresse'];
			$tel_fixe =$cpl['tel_fixe'];
			$tel_box =$cpl['tel_box'];
			$mobile =$cpl['mobile'];
			$email =$cpl['email'];
			
		}
		
		$text = "Madame, Monsieur  ".$user ->getUsername()."
				
				Nous avons bien pris connaissance de votre demande de fiche 
				Aussi nous vous transmettons le plus rapidement la fiche de complement 
				afin de contacter au mieux votre contact
				
				Cordialement
				
				
				";
		
		
		$message = \Swift_Message::newInstance()
		->setSubject('Fiche Personne')
		->setFrom('quim.deconection23@gmail.com')
		->setTo($EmailUser)
		->setBody(
				 $this->render("LoginLoginBundle:Carnet:sendContact.html.twig",
				 		array(
				 				
				 			'text' =>$text,
				 			'nom' =>$nom,
				 			'prenom' => $prenom,
				 			'adresse' =>$adresse,
				 			'tel_fixe' =>$tel_fixe,
				 			'tel_box' =>$tel_box,
				 			'mobile' =>$mobile,
				 			'email' =>$email
				 					 				
				 		)
				 		
				 		));
		$this->get('mailer')->send($message);
		
	
		
		return $this->render("LoginLoginBundle:Carnet:sendContact.html.twig", 
				array(
							'text' =>$text,
				 			'nom' =>$nom,
				 			'prenom' => $prenom,
				 			'adresse' =>$adresse,
				 			'tel_fixe' =>$tel_fixe,
				 			'tel_box' =>$tel_box,
				 			'mobile' =>$mobile,
				 			'email' =>$email));
		
		
		
		
		}
	}
}