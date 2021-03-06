<?php

namespace LSB\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BoardGame
 *
 * @ORM\Table(name="board_game")
 * @ORM\Entity(repositoryClass="LSB\AppBundle\Repository\BoardGameRepository")
 */
class BoardGame
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
     * @return BoardGame
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
     * Set mode
     *
     * @param string $mode
     *
     * @return BoardGame
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
     * Set meetingDate
     *
     * @param \LSB\AppBundle\Entity\MeetingDate $meetingDate
     *
     * @return BoardGame
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
     * @return BoardGame
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
     * @return BoardGame
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
     * @return BoardGame
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
