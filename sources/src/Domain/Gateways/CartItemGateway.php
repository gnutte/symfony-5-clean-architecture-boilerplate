<?php

namespace App\Domain\Gateways;

use App\Entity\Product;

interface CartItemGateway
{
    public function getItemByProduct(Product $product);
}