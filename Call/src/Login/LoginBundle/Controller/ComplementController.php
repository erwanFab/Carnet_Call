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
		

		
		
		var_dump($id);
		// parameters to template
		return $this->render('LoginLoginBundle:Carnet:Complement.html.twig',array('nom'=>$nom , 'prenom'=>$prenom ));
		
	}
	
	
}