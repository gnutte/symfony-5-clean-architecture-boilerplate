<?php

declare(strict_types=1);

namespace App\BusinessRules\UseCase\Cart;

class GetCartForUSerInput
{
    private string $username;

    public function setUsername(string $username): GetCartForUSerInput
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;

    }
}