<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Event\Exceptions\Model\Cart\CartCanNotBeSavedException;
use App\Domain\Gateways\CartGateway;
use App\Domain\Model\Cart;
use App\Domain\Model\User;
use App\Infrastructure\Entity\CartImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class CartRepository extends ServiceEntityRepository implements CartGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartImpl::class);
    }

    public function retrieveCartForUser(User $user): ?Cart
    {
        /** @var Cart $cart */
        $cart = $this->findOneBy(['user' => $user->getUsername()]);
        return $cart;
    }

    /**
     * @throws CartCanNotBeSavedException
     */
    public function update(Cart $cart): CartGateway
    {
        try {
            $this->_em->persist($cart);
            $this->_em->flush();

            return $this;
        } catch (OptimisticLockException|ORMException $e) {
            throw new CartCanNotBeSavedException($e->getMessage());
        }
    }

    /**
     * @throws CartCanNotBeSavedException
     */
    public function createForUser(User $user): Cart
    {
        $cart = new CartImpl($user);

        try {
            $this->_em->persist($cart);
            $this->_em->flush();

            return $cart;
        } catch (OptimisticLockException|ORMException $e) {
            throw new CartCanNotBeSavedException($e->getMessage());
        }
    }
}