<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\Model\Cart;
use App\Domain\Model\CartItem;
use App\Domain\Model\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 * @ORM\Table(name="cart")
 */
class CartImpl extends Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    protected int $id;

    /**
     * @ORM\OneToOne(targetEntity="UserImpl")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    protected User $user;

    /**
     * @ORM\OneToMany(targetEntity="CartItemImpl", mappedBy="cart", cascade={"persist"})
     * @ORM\JoinColumn(name="item", referencedColumnName="id")
     */
    protected Collection $items;

    protected function createNewCartItemLine(): CartItem
    {
        return new CartItemImpl();
    }
}