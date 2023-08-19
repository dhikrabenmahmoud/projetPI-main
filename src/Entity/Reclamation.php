<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="lObjet est necessaire")
     * @Assert\Length(
     *      min = 4,
     *      max = 30,
     *      minMessage = "LObjet doit contenir au moins {{ limit }} characteres",
     *      maxMessage = "LObjet  doit contenir au plus {{ limit }} characteres"
     * )
     */
    private $objet;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le contenu est necessaire")
     * @Assert\Length(
     *      min = 10,
     *      max = 250,
     *      minMessage = "Le contenu doit contenir au moins {{ limit }} characteres",
     *      maxMessage = "Le contenu doit contenir au plus {{ limit }} characteres"
     * )
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;


    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(?\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }



}
