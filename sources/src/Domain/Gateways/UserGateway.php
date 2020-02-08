<?php

declare(strict_types=1);

namespace App\Domain\Gateways;

use App\Domain\Model\User;

interface UserGateway
{
    public function retrieve(string $username): ?User;
}