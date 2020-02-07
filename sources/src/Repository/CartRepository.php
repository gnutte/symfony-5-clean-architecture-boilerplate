<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Gateways\CartGateway;
use App\Entity\Cart;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CartRepository extends ServiceEntityRepository implements CartGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

}