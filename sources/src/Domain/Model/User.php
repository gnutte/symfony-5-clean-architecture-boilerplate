<?php

declare(strict_types=1);

namespace App\Domain\Model;

class User
{
    protected int $id;
    protected string $username;
    protected string $password;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}