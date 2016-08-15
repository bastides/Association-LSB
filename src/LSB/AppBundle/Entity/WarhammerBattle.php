<?php

namespace LSB\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * WarhammerBattle
 *
 * @ORM\Table(name="warhammer_battle")
 * @ORM\Entity(repositoryClass="LSB\AppBundle\Repository\WarhammerBattleRepository")
 */
class WarhammerBattle
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
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode;

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
     * @ORM\ManyToOne(targetEntity="LSB\AppBundle\Entity\MeetingDate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meetingDate;

    /**
     * @ORM\ManyToMany(targetEntity="LSB\UserBundle\Entity\User", cascade={"persist"})
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="LSB\UserBundle\Entity\User", cascade={"persist"})
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
     * @return WarhammerBattle
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
     * @return WarhammerBattle
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
     * Set mode
     *
     * @param string $mode
     *
     * @return WarhammerBattle
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set armyPoints
     *
     * @param integer $armyPoints
     *
     * @return WarhammerBattle
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
     * Set meetingDate
     *
     * @param \LSB\AppBundle\Entity\MeetingDate $meetingDate
     *
     * @return WarhammerBattle
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
     * @param \LSB\UserBundle\Entity\User $user
     *
     * @return WarhammerBattle
     */
    public function addUser(\LSB\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \LSB\UserBundle\Entity\User $user
     */
    public function removeUser(\LSB\UserBundle\Entity\User $user)
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
     * @return WarhammerBattle
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
     * @param \LSB\UserBundle\Entity\User $creator
     *
     * @return WarhammerBattle
     */
    public function setCreator(\LSB\UserBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \LSB\UserBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
