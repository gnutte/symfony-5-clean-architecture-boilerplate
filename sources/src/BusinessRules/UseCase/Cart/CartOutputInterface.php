<?php

namespace App\BusinessRules\UseCase\Cart;

use App\Domain\Model\Cart;

interface CartOutputInterface
{
    public function setCart(Cart $cart): CartOutputInterface;

    public function getCart(): Cart;
}