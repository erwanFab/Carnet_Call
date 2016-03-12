<?php
namespace Login\LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="carnet")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Carnet 
{

	/**
	 * @var decimal $id
	 * @ORM\Column(name="id_personne", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\OneToOne(targetEntity="complement", mappedBy="carnet", cascade={"persist", "remove", "merge"})
     */
	
	private $id_personne;

	/**
	 * @var decimal $id_cat
	 * @ORM\Column(name="id_cat", type="integer")
	 * @ORM\ManyToOne(targetEntity="Categories", inversedBy="carnet",  cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_cat", referencedColumnName="id")
     * })
	 */
	
	private $id_cat;
	
	/**
	 * @var decimal $image_id
	 * @ORM\Column(name="image_id", type="integer")
	 * @ORM\ManyToOne(targetEntity="Avatar", inversedBy="carnet",  cascade={"persist", "remove", "merge"})
	 * @ORM\JoinColumns({
	 *  @ORM\JoinColumn(name="image_id", referencedColumnName="id")
	 * })
	 */
	
	private $image_id;
	/**
	 * @var text $nom
	 *
	 * @ORM\Column(name="nom", type="string", length=255, nullable=false)
	 */
	private $nom;
	
	/**
	 * @var text $prenom
	 *
	 * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
	 */
	private $prenom;
	
	
	
	
	
	/*	-----------------------------------------------------------------------------------------	*/
	
	public function __construct() {
		$this->carnet = new ArrayCollection();
	}
	
	}
	
	
