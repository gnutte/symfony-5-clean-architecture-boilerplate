<?php

declare(strict_types=1);

namespace App\Domain\Gateways;

use App\Domain\Event\Exceptions\Model\Cart\CartCanNotBeSavedException;
use App\Domain\Model\Cart;
use App\Domain\Model\User;

interface CartGateway
{
    public function retrieveCartForUser(User $user): ?Cart;

    /**
     * @throws CartCanNotBeSavedException
     */
    public function update(Cart $cart): CartGateway;

    /**
     * @throws CartCanNotBeSavedException
     */
    public function createForUser(User $user): Cart;
}