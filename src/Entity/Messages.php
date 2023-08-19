<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessagesRepository::class)
 */
class Messages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $senderId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $recipientId;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank(message="Veuillez saisir un message")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderId(): ?User
    {
        return $this->senderId;
    }

    public function setSenderId(?User $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getRecipientId(): ?User
    {
        return $this->recipientId;
    }

    public function setRecipientId(?User $recipientId): self
    {
        $this->recipientId = $recipientId;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
