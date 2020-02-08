<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"persist"})
     * @ORM\JoinColumn(name="item", referencedColumnName="id")
     */
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUser(User $user): Cart
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function addItem(CartItem $item): Cart {
        $this->items->add($item);
        return $this;
    }

    public function removeItem(CartItem $item): Cart {
        $this->items->removeElement($item);
        return $this;
    }

    public function getItems(): array {
        return $this->items->getValues();
    }
}