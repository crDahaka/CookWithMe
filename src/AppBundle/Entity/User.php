<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank(message="Username cannot be blank.")
     * @Assert\Length(
     *     min=3,
     *     max=25,
     *     minMessage="Username cannot be less than 3 characters.",
     *     maxMessage="Username cannot be more than 25 characters."
     * )
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Invalid first name.")
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Invalid last name.")
     */
    protected $lastName;


    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\Email(message="Invalid email address.")
     */
    protected $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive = 1;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $salt;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username){
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName(){
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(){
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword(){
        return $this->plainPassword;
    }

    /**
     * @param string $password
     */
    public function setPlainPassword($password){
        $this->plainPassword = $password;
    }

    /**
     * @return bool
     */
    public function getIsActive(){
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    /**
     * @return array
     */
    public function getRoles(){
        return array('ROLE_USER');
    }

    /**
     * @return array
     */
    public function getSalt(){
        return $this->salt;
    }

    public function setSalt(){
        $this->salt = $this->generateSalt();
    }

    /**
     * @return array
     */
    private function generateSalt(){
        $generatedSalt = uniqid($this->getUsername(), $more_entropy = true);

        return $generatedSalt;
    }

    public function eraseCredentials(){
    }

}