<?php

declare(strict_types=1);

namespace App\BusinessRules\UseCase\Cart;

use App\Domain\Model\Cart;

class GetCartForUSerOutput implements CartOutputInterface
{
    private Cart $cart;

    public function setCart(Cart $cart): CartOutputInterface
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}