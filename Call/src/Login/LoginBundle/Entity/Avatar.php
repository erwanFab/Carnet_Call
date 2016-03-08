<?php
namespace Login\LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="avatar")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Avatar 
{

	/**
	 * @var decimal $id
	 * @ORM\Column(name="id", type="int")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\OneToMany(targetEntity="carnet", mappedBy="avatar", cascade={"persist", "remove", "merge"})
	 */
	private $id;

	/**
	 * @var text $picture_name
	 *
	 * @ORM\Column(name="picture_name", type="string", length=255, nullable=false)
	 */
	private $picture_name;
	
	  /**

     * @Assert\File(

     *     maxSize = "5M",

     *     mimeTypes = {"photo/jpeg","photo/jpg", "photo/png", "photo/gif"},

     *     mimeTypesMessage = "ce format de photo est inconnu",

     *     uploadIniSizeErrorMessage = "uploaded file is larger than the upload_max_filesize PHP.ini setting",

     *     uploadFormSizeErrorMessage = "uploaded file is larger than allowed by the HTML file input field",

     *     uploadErrorMessage = "uploaded file could not be uploaded for some unknown reason",

     *     maxSizeMessage = "fichier trop volumineux"

     * )

     */
	public $file;
	
	
	
	
	
	
/*	---------------------------------------------------------------------	*/
	
	 
	public function getWebPath()
	{
		return null === $this->picture-name ? null : $this->getUploadDir().'/'.$this->picture_name;
	}
	
	protected function getUploadRootDir()
	{
		// le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}
	
	protected function getUploadDir()
	{
		// get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
		return 'uploads/pictures/';
	}
	 
	public function uploadProfilePicture()
	{
		// Nous utilisons le nom de fichier original, donc il est dans la pratique
		// nécessaire de le nettoyer pour éviter les problèmes de sécurité
	
		// move copie le fichier présent chez le client dans le répertoire indiqué.
		$this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
	
		// On sauvegarde le nom de fichier
		$this->picture_name = $this->file->getClientOriginalName();
		 
		// La propriété file ne servira plus
		$this->file = null;
	}
	
	
	/*	-----------------------------------------------------------------------------------------	*/
	
	public function __construct() {
		$this->avatar = new ArrayCollection();
	}
}