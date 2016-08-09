<?php

namespace LSB\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="players", type="integer")
     */
    private $players;

    /**
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255)
     */
    private $mode;

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
     * @param \LSB\UserBundle\Entity\User $user
     *
     * @return BoardGame
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
}
