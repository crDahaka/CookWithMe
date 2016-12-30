<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $salt;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive = 1;

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
    public function getUsername(){
        return $this->email;
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
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword){
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getRole(){
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role = null){
        $this->role = $role;
    }

    /**
     * @return array
     */
    public function getRoles(){
        return [$this->getRole()];
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
    public function getSalt(){
        return $this->salt;
    }

    /**
     * @return array
     */
    private function generateSalt(){
        $generatedSalt = uniqid($this->getUsername(), $more_entropy = true);
        return $generatedSalt;
    }

    public function setSalt(){
        $this->salt = $this->generateSalt();
    }

    public function eraseCredentials(){
        return null;
    }

    public function __toString(){
        return (string) $this->getName();
    }
}
