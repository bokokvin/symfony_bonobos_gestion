<?php

namespace BK\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Ami
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BK\PlatformBundle\Entity\AmiRepository")
 */
class Ami implements UserInterface
{
	/**
    * @ORM\ManyToMany(targetEntity="BK\PlatformBundle\Entity\Ami")
    */
    private $amis;
   
	
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;
	
	
	 /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
	
	 
    



    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="famille", type="string", length=255)
     */
    private $famille;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="nourriture", type="string", length=255)
     */
    private $nourriture;
	
	
	
	public function __construct()
    {
        $this->amis = new ArrayCollection();
    }
	
	
	public function addAmi(Ami $ami)
	{
		$this->amis[] = $ami;

		return $this;
	}

	
	public function removeAmi(Ami $ami)
	{
		$this->amis->removeElement($ami);
	}
	
	
	public function getAmis()
	{
    return $this->amis;
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Ami
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

  

    /**
     * Set age
     *
     * @param integer $age
     * @return Ami
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set famille
     *
     * @param string $famille
     * @return Ami
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string 
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set race
     *
     * @param string $race
     * @return Ami
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set nourriture
     *
     * @param string $nourriture
     * @return Ami
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    /**
     * Get nourriture
     *
     * @return string 
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }
	
	
	public function getRoles()
    {
    //   return array('ROLE_USER');
    }

    public function getPassword()
    {
        return $this->password;
    }
	
	/**
     * Set password
     *
     * @param string $password
     * @return Ami
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {

    }
	
	public function getUsername()
    {
        
    }
	
	public function eraseCredentials()
    {
    }
}
