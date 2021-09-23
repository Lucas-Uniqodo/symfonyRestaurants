<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="restaurantId")
     */
    private $restaurantId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, name="imageLink")
     */
    private $imageLink;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="restaurantId", orphanRemoval=true)
     */
    private $menus;


    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
    }

    public function getMenus(): Collection
    {
        return $this->menus;
    }


    public function getRestaurantId(): ?int
    {
        return $this->restaurantId;
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

    public function getImageLink(): ?string
    {
        return $this->imageLink;
    }

    public function setImageLink(string $imageLink): self
    {
        $this->imageLink = $imageLink;

        return $this;
    }
    public function jsonSerialize()
    {
        return ['id' => $this->getRestaurantId(), 'name' => $this->getName(), 'imageLink' => $this->getImageLink(), 'menus' => $this->getMenus()];
    }
}
