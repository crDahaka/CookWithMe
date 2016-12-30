<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/11/2016
 * Time: 13:51
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="ingredients")
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Recipe", mappedBy="ingredients", fetch="EXTRA_LAZY")
     */
    protected $recipes;

    public function __construct(){
        $this->recipes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }

}