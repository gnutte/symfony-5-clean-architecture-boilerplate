<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Model\Cart;
use App\Domain\Model\CartItem;
use App\Domain\Model\Product;
use App\Domain\Model\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\CartRepository")
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
     * @ORM\JoinColumn(name="user", referencedColumnName="username")
     */
    protected User $user;

    /**
     * @ORM\OneToMany(targetEntity="CartItemImpl", mappedBy="cart", cascade={"persist"})
     * @ORM\JoinColumn(name="item", referencedColumnName="id")
     */
    protected Collection $items;

    protected function createNewCartItemLine(Cart $cart, Product $product): CartItem
    {
        return new CartItemImpl($cart, $product);
    }
}