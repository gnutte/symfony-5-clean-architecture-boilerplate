<?php

namespace App\Domain\Gateways;

use App\Domain\Model\Product;

interface CartItemGateway
{
    public function getItemByProduct(Product $product);
}