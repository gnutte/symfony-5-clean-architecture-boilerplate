<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\Model\Cart;
use App\Domain\Model\CartItem;
use App\Domain\Model\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartItemRepository")
 * @ORM\Table(name="cart_item")
 */
class CartItemImpl extends CartItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="CartImpl", inversedBy="items", cascade={"persist"})
     */
    protected Cart $cart;

    /**
     * @ORM\ManyToOne(targetEntity="ProductImpl")
     * @ORM\JoinColumn(name="product", referencedColumnName="sku")
     */
    protected Product $product;

    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    protected int $quantity = 0;

}