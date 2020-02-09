<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Model\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class UserImpl extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", name="username", unique=true)
     */
    protected string $username;

    /**
     * @ORM\Column(type="string", name="password")
     */
    protected string $password;
}