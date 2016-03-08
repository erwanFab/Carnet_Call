<?php
namespace Login\LoginBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Login\LoginBundle\Form\AvatarType;




use Login\LoginBundle\Entity\Avatar;

/**
 * Avatar controller.
 *
 */
class AvatarController extends Controller

{
	/*
	 * On fabrique un formulaire pour l'utilisation des avatar ultérieurment
	 * Pour cela on crée un formType apprellé Avatartype qui permetra de parcourir le disque et de rechercher 
	 * la photo qui nous intéresse
	 * Une fois celle-ci selectionner 
	 * la fonction uploadProfilePicture permettre à la fois de copier dans la Bdd le nom de la photo
	 * colonne picture_name 
	 * Deplus cette fonction renvoie  la copie de cette photo dans le répertoir Uploads/picture 
	 * Une fois ces opération effectuer 
	 * on renvoie à la page d'acceuil
	 */
	public function newAction (Request $request){
		
	$avatar = new Avatar();
	$form = $this->createForm(AvatarType::class, $avatar);
	
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $avatar ->uploadProfilePicture();
            $em->persist($avatar);
            $em->flush();
			
			
            return $this->redirect($this->generateUrl('login_login_homepage'));
        }

        return $this->render('LoginLoginBundle:Avatar:AvatarNew.html.twig', array(
            'Avatar' => $avatar,
            'formAvatar' => $form->createView(),
        ));
    }
}