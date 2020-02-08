<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\Model\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class UserImpl extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", name="username")
     */
    protected string $username;

    /**
     * @ORM\Column(type="string", name="password")
     */
    protected string $password;
}