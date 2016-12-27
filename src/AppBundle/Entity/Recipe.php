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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/png"}
     * )
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="recipes")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="recipe")
     */
    protected $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="recipes", cascade={"persist"})
     * @ORM\JoinColumn(name="recipes_ingredients")
     */
    protected $ingredients;

    public function __construct(){
        $this->createdAt = new \DateTime();
        $this->isPublic = false;
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
        $this->ingredients->add($ingredient);
    }

    /**
     * @param Ingredient $ingredient
     */
    public function removeIngredient(Ingredient $ingredient){
        $this->ingredients->removeElement($ingredient);
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

    /**
     * @return string
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image){
        $this->image = $image;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category){
        $this->category = $category;
    }

}