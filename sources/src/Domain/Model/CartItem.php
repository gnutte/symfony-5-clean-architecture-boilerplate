<?php

declare(strict_types=1);

namespace App\Domain\Model;

class CartItem implements ModelInterface
{
    protected Cart $cart;
    protected Product $product;
    protected int $quantity;

    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->product = $product;
        $this->quantity = 0;
    }

    public function increaseQuantity(int $quantity): CartItem
    {
        $this->quantity += $quantity;
        return $this;
    }

    public function decreaseQuantity(int $quantity): CartItem
    {
        $this->quantity -= $quantity;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}