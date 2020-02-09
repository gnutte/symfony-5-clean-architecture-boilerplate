<?php

declare(strict_types=1);

namespace App\BusinessRules\UseCase\Cart;

use App\Domain\Event\Exceptions\Model\Cart\CartCanNotBeSavedException;
use App\Domain\Gateways\CartGateway;
use App\Domain\Gateways\UserGateway;
use App\Domain\Model\User;
use App\Infrastructure\Entity\CartImpl;

class GetCartForUSer
{
    private UserGateway $userGateway;
    private CartGateway $cartGateway;

    public function __construct(UserGateway $userGateway, CartGateway $cartGateway)
    {
        $this->userGateway = $userGateway;
        $this->cartGateway = $cartGateway;
    }

    /**
     * @throws CartCanNotBeSavedException
     */
    public function execute(GetCartForUSerInput $input): GetCartForUSerOutput {

        /** @var User $user */
        $user = $this->userGateway->retrieve($input->getUsername());

        $cart = $this->cartGateway->retrieveCartForUser($user);
        if(null == $cart) {
            $cart = $this->cartGateway->createForUser($user);
        }

        $output = new GetCartForUSerOutput();
        $output->setCart($cart);
        return $output;
    }
}