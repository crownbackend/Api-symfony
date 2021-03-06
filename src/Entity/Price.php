<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull()
     * @Assert\Choice(choices={"less_than_12", "for_all"})
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotNull()
     * @Assert\Type(type="numeric")
     * @Assert\GreaterThan(value="0")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;
    /**
     * @Groups({"place", "price"})
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @Groups({"place", "price"})
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
    /**
     * @Groups({"place", "price"})
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }
    /**
     * @Groups("price")
     */
    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }
}
