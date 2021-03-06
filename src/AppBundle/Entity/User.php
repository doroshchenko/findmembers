<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var null
     *  @ORM\OneToMany(targetEntity="Event", mappedBy="author")
     */
    protected $events = null;

    /**
     * @var null
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="members")
     */
    private $joined_events = null;

    /**
     * @var null
     * @ORM\ManyToMany(targetEntity="UserConversation", mappedBy="users")
     *
     */
    private $conversations = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    private $image;

    /**
     * @var null
     * @ORM\OneToMany(targetEntity="UserMessage", mappedBy="author")
     */
    private $messages = null;

    public function __construct()
    {
        parent::__construct();
        // your own logic

        $this->events = new ArrayCollection();
        $this->joined_events = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    /**
     * Add event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return User
     */
    public function addEvent(\AppBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \AppBundle\Entity\Event $event
     */
    public function removeEvent(\AppBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add joinedEvent
     *
     * @param \AppBundle\Entity\Event $joinedEvent
     *
     * @return User
     */
    public function addJoinedEvent(\AppBundle\Entity\Event $joinedEvent)
    {
        $this->joined_events[] = $joinedEvent;

        return $this;
    }

    /**
     * Remove joinedEvent
     *
     * @param \AppBundle\Entity\Event $joinedEvent
     */
    public function removeJoinedEvent(\AppBundle\Entity\Event $joinedEvent)
    {
        $this->joined_events->removeElement($joinedEvent);
    }

    /**
     * Get joinedEvents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJoinedEvents()
    {
        return $this->joined_events;
    }

    /**
     * Add conversation
     *
     * @param \AppBundle\Entity\UserConversation $conversation
     *
     * @return User
     */
    public function addConversation(\AppBundle\Entity\UserConversation $conversation)
    {
        $this->conversations[] = $conversation;

        return $this;
    }

    /**
     * Remove conversation
     *
     * @param \AppBundle\Entity\UserConversation $conversation
     */
    public function removeConversation(\AppBundle\Entity\UserConversation $conversation)
    {
        $this->conversations->removeElement($conversation);
    }

    /**
     * Get conversations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversations()
    {
        return $this->conversations;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\UserMessage $message
     *
     * @return User
     */
    public function addMessage(\AppBundle\Entity\UserMessage $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\UserMessage $message
     */
    public function removeMessage(\AppBundle\Entity\UserMessage $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function setImage($image)
    {
       $this->image = $image;

        return $this->image;
    }

    public function getImage()
    {
        return $this->image;
    }
}
