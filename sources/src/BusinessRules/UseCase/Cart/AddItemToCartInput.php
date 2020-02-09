<?php

declare(strict_types=1);

namespace App\BusinessRules\UseCase\Cart;

class AddItemToCartInput
{

    private array $data;
    private string $username;

    public function setData(array $data): AddItemToCartInput
    {
        $this->data = $data;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): AddItemToCartInput
    {
        $this->username = $username;
        return $this;
    }
}