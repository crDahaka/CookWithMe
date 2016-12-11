<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/11/2016
 * Time: 13:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", length=250)
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="comments")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    protected $recipe;

    public function __construct(){
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
    public function getContent(){
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content){
        $this->content = $content;
    }

    /**
     * @return Recipe
     */
    public function getRecipe(){
        return $this->recipe;
    }

    /**
     * @param Recipe $recipe
     */
    public function setRecipe(Recipe $recipe){
        $this->recipe = $recipe;
    }

}