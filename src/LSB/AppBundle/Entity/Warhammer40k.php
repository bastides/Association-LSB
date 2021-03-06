<?php

namespace LSB\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Warhammer40k
 *
 * @ORM\Table(name="warhammer40k")
 * @ORM\Entity(repositoryClass="LSB\AppBundle\Repository\Warhammer40kRepository")
 */
class Warhammer40k
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 100,
     *      minMessage = "Vous devez rentrer au moins {{ limit }} caractère",
     *      maxMessage = "Vous ne pouvez pas rentrer plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="players", type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez rentrer au moins {{ limit }} joueur",
     *      maxMessage = "Vous ne pouvez pas rentrer plus de {{ limit }} joueurs"
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de joueurs doit être un chiffre."
     * )
     */
    private $players;

    /**
     * @var string
     *
     * @ORM\Column(name="style", type="string", length=255)
     */
    private $style;

    /**
     * @var int
     *
     * @ORM\Column(name="armyPoints", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de points d'armée doit être un chiffre."
     * )
     */
    private $armyPoints;

    /**
     * @var int
     *
     * @ORM\Column(name="cpmPoints", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de points cpm doit être un chiffre."
     * )
     */
    private $cpmPoints;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\AppBundle\Entity\MeetingDate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meetingDate;

    /**
     * @ORM\ManyToMany(targetEntity="LSB\AppBundle\Entity\User", cascade={"persist"})
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="LSB\AppBundle\Entity\User", cascade={"persist"})
     */
    private $creator;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set players
     *
     * @param integer $players
     *
     * @return Warhammer40k
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * Get players
     *
     * @return int
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Warhammer40k
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set armyPoints
     *
     * @param integer $armyPoints
     *
     * @return Warhammer40k
     */
    public function setArmyPoints($armyPoints)
    {
        $this->armyPoints = $armyPoints;

        return $this;
    }

    /**
     * Get armyPoints
     *
     * @return int
     */
    public function getArmyPoints()
    {
        return $this->armyPoints;
    }

    /**
     * Set cpmPoints
     *
     * @param integer $cpmPoints
     *
     * @return Warhammer40k
     */
    public function setCpmPoints($cpmPoints)
    {
        $this->cpmPoints = $cpmPoints;

        return $this;
    }

    /**
     * Get cpmPoints
     *
     * @return int
     */
    public function getCpmPoints()
    {
        return $this->cpmPoints;
    }

    /**
     * Set meetingDate
     *
     * @param \LSB\AppBundle\Entity\MeetingDate $meetingDate
     *
     * @return Warhammer40k
     */
    public function setMeetingDate(\LSB\AppBundle\Entity\MeetingDate $meetingDate)
    {
        $this->meetingDate = $meetingDate;

        return $this;
    }

    /**
     * Get meetingDate
     *
     * @return \LSB\AppBundle\Entity\MeetingDate
     */
    public function getMeetingDate()
    {
        return $this->meetingDate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \LSB\AppBundle\Entity\User $user
     *
     * @return Warhammer40k
     */
    public function addUser(\LSB\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \LSB\AppBundle\Entity\User $user
     */
    public function removeUser(\LSB\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Warhammer40k
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creator
     *
     * @param \LSB\AppBundle\Entity\User $creator
     *
     * @return Warhammer40k
     */
    public function setCreator(\LSB\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \LSB\AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
