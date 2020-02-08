<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Event\Exceptions\Model\BadModelDataException;

class User implements ModelInterface
{
    protected string $username;
    protected string $password;

    /**
     * @throws BadModelDataException
     */
    public function __construct(string $username)
    {
        $this->setUsername($username);
    }

    /**
     * @throws BadModelDataException
     */
    protected function setUsername(string $username): void
    {
        if ('' === $username) {
            throw new BadModelDataException($this, 'username', 'User login can not be empty.');
        }

        $this->username = $username;
    }

    /**
     * @throws BadModelDataException
     */
    public function updatePassword(string $password): User
    {
        if('' === $password) {
            throw new BadModelDataException($this, 'password', 'User password can not be empty.');
        }

        $this->password = $password;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}