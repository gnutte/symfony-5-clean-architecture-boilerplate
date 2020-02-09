<?php

declare(strict_types=1);

namespace App\Application\Ui\View\Cart;

use App\BusinessRules\UseCase\Cart\CartOutputInterface;
use App\Domain\Model\Cart;

class CartView implements CartViewInterface
{
    private Cart $cart;
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function buildFromOutput(CartOutputInterface $output): CartViewInterface
    {
        $this->cart = $output->getCart();
        return $this;
    }

    public function addError(string $error): CartViewInterface
    {
        $this->errors[] = $error;
        return $this;
    }

    public function getItems(): array {
        return $this->cart->getItems();
    }

    public function getTotalPrice(): float {
        return $this->cart->getTotalPrice();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}