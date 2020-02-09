<?php

namespace App\Application\Ui\View\Cart;

use App\BusinessRules\UseCase\Cart\CartOutputInterface;

interface CartViewInterface
{
    public function buildFromOutput(CartOutputInterface $output): CartViewInterface;

    public function addError(string $error): CartViewInterface;

    public function getItems(): array;

    public function getTotalPrice(): float;

    public function getErrors(): array;
}