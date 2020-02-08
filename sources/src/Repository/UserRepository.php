<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Gateways\UserGateway;
use App\Entity\UserImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserImpl::class);
    }

}