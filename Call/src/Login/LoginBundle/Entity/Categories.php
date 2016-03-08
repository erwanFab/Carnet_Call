<?php

namespace Login\LoginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories 
{
    /**
     * @var decimal $id
     * @ORM\Column(name="id", type="int")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="carnet", mappedBy="categories", cascade={"persist", "remove", "merge"})
     */
    private $id;

    /**
     * @var text $nom
     *
     * @ORM\Column(name="nom_categorie", type="string", length=255, nullable=false)
     */
    private $nom_categorie;

    
/*	----------------------------------------------------------------------------------------	*/  
    
     
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
 /*---------------------------------------*/   
   
    /**
     * @param text $nom
     */
    public function setNom($nom_categorie)
    {
    	$this->nom_categorie = $nom_categorie;
    }
    
    /**
     * @return text $nom
     */
    public function getNom()
    {
    	return $this->nom_categorie;
    }
    
/*	-----------------------------------------------------------------------------------------	*/  
    
    public function __construct() {
    	$this->categories = new ArrayCollection();
    }
    
}

