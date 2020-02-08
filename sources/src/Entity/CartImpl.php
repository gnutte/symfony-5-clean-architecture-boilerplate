<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\Model\Cart;
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
     * @ORM\OneToMany(targetEntity="CartItemImpl", mappedBy="cart", cascade={"persist"})
     * @ORM\JoinColumn(name="item", referencedColumnName="id")
     */
    protected Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}