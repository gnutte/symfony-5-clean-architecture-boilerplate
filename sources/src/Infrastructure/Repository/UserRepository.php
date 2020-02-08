<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Gateways\UserGateway;
use App\Domain\Model\User;
use App\Infrastructure\Entity\UserImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserImpl::class);
    }

    public function retrieve(string $username): ?User
    {
        /** @var User $user */
        $user = $this->findOneBy(['username' => $username]);
        return $user;
    }
}