<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartItemRepository")
 */
class CartItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="items", cascade={"persist"})
     */
    private Cart $cart;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product", referencedColumnName="id")
     */
    private Product $product;

    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    private int $quantity = 0;

    public function setQuantity(int $quantity): CartItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function setProduct(Product $product): CartItem
    {
        $this->product = $product;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setCart(Cart $cart): CartItem
    {
        $this->cart = $cart;
        return $this;
    }
}