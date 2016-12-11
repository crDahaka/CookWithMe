<?php
/**
 * Created by PhpStorm.
 * User: CR
 * Date: 12/8/2016
 * Time: 16:58
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipes")
 */
class Recipe
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Title cannot be blank")
     */
    protected $title;

    /**
     * @ORM\Column(type="text", length=250)
     * @Assert\NotBlank(message="Preparation cannot be blank.")
     */
    protected $preparation;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isPublic;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="recipe")
     */
    protected $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="recipes")
     * @ORM\JoinColumn(name="recipes_ingredients")
     */
    protected $ingredients;

    public function __construct(){
        $this->comments = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
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
    public function getTitle(){
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getPreparation(){
        return $this->preparation;
    }

    /**
     * @param string $preparation
     */
    public function setPreparation($preparation){
        $this->preparation = $preparation;
    }

    /**
     * @return bool
     */
    public function getIsPublic(){
        return $this->isPublic;
    }

    /**
     * @param string $isPublic
     */
    public function setIsPublic($isPublic){
        $this->isPublic = $isPublic;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(){
        return $this->createdAt;
    }

    /**
     * @return User
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user){
        $this->user = $user;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient){
        $this->ingredients[] = $ingredient;
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredients(){
        return $this->ingredients;
    }

    /**
     * @param $ingredients
     */
    public function setIngredients($ingredients){
        $this->ingredients = $ingredients;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment){
        $this->comments[] = $comment;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments(){
        return $this->comments;
    }

    /**
     * @param $comments
     */
    public function setComments($comments){
        $this->comments = $comments;
    }

}