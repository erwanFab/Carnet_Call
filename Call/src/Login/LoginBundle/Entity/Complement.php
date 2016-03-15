<?php
namespace Login\LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="complement")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Complement
{

	/**
	 * @var decimal $id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 */

	private $id;

	
		/**
		 * @var decimal $personne
		 * @ORM\Column(name="personne", type="integer")
		 * @ORM\OneToOne(targetEntity="carnet", mappedBy="complement", cascade={"persist", "remove", "merge"})
		 */
	
		private $personne;
	
		/**
		 *  @var string $adresse
		 *  @ORM\Column(name="adresse", type="string", length=255, nullable=false)
		 *  
		 */

		private $adresse;
		
		
		/**
		 *  @var string $email
		 *  @ORM\Column(name="email", type="string", length=255, nullable=false)
		 *
		 */
		
		private $email;
		
		
		/**
		 *  @var string $tel_fixe
		 *  @ORM\Column(name="tel_fixe", type="string", length=255, nullable=false)
		 *
		 */
		
		private $tel_fixe;
		


		/**
		 *  @var string $tel_box
		 *  @ORM\Column(name="tel_box", type="string", length=255, nullable=false)
		 *
		 */
		
		private $tel_box;
		
		/**
		 *  @var string $mobile
		 *  @ORM\Column(name="mobile", type="string", length=255, nullable=false)
		 *
		 */
		
		private $mobile;
		
		/*	-----------------------------------------------------------------------------------------	*/
		
		public function __construct() {
			$this->complement = new ArrayCollection();
		}
		



}