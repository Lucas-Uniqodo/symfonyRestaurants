<?php

namespace App\Entity;

use App\Repository\MenuItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuItemRepository::class)
 * @ORM\Table(name="menuItem")
 */
class MenuItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="menuItemId")
     */
    private $menuItemId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumn(name="menuId", referencedColumnName="menuId")
     */
    private $menuId;


    public function getMenuItemId(): ?int
    {
        return $this->menuItemId;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMenuId(): ?Menu
    {
        return $this->menuId;
    }

    public function setMenuId(?Menu $menuId): self
    {
        $this->menuId = $menuId;

        return $this;
    }
}
