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
class Carnet 
{

	/**
	 * @var decimal $id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	 */
	private $id;

	
	
	
	
	
	
	
	
	/*	-----------------------------------------------------------------------------------------	*/
	
	public function __construct() {
		$this->carnet = new ArrayCollection();
	}
	
	}
	
	
