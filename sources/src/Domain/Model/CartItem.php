<?php

declare(strict_types=1);

namespace App\Domain\Model;

class CartItem
{
    protected int $id;
    protected Cart $cart;
    protected Product $product;
    protected int $quantity = 0;

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