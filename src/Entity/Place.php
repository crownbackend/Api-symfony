<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 * @UniqueEntity("name")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le nom ne peut être vide")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Il faut au minimum {{ limit }} caractères",
     *      maxMessage = "Il faut au maximum {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="l'adresse ne peut être vide")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Il faut au minimum {{ limit }} caractères",
     *      maxMessage = "Il faut au maximum {{ limit }} caractères"
     * )
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
