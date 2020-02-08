<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Gateways\CartItemGateway;
use App\Domain\Model\Product;
use App\Entity\CartItemImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CartItemRepository extends ServiceEntityRepository implements CartItemGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItemImpl::class);
    }

    public function getItemByProduct(Product $product)
    {
        return $this->findOneBy(['product' => $product->getId()]);
    }

}