<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Gateways\CartItemGateway;
use App\Entity\CartItem;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CartItemRepository extends ServiceEntityRepository implements CartItemGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function getItemByProduct(Product $product)
    {
        return $this->findOneBy(['product' => $product->getId()]);
    }

}