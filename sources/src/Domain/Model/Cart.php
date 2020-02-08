<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Event\Exceptions\Model\Cart\ProductNotInCartException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Cart
{
    protected User $user;
    protected Collection $items;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->items = new ArrayCollection();
    }

    public function add(Product $product, int $quantity): Cart {
        $cartItem = $this->getCartItemForProduct($product);
        if(null == $cartItem) {
            $cartItem = $this->createNewCartItemLine();
            $cartItem->setCart($this);
            $cartItem->setProduct($product);
            $cartItem->setQuantity($quantity);
            $this->items->add($cartItem);
        }else{
            $cartItem->setQuantity($cartItem->getQuantity() + $quantity);
        }

        return $this;
    }

    /**
     * @throws ProductNotInCartException
     */
    public function remove(Product $product, int $quantity): Cart {
        $cartItem = $this->getCartItemForProduct($product);
        if(null == $cartItem) {
            throw new ProductNotInCartException();
        }

        if($quantity >= $cartItem->getQuantity()) {
            $this->items->removeElement($cartItem);
        }else{
            $cartItem->setQuantity($cartItem->getQuantity() - $quantity);
        }

        return $this;
    }

    public function getTotalPrice(): float {
        $total = 0;
        foreach ($this->items as $item) {
            /** @var CartItem $item */
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }

        return $total;
    }

    public function getItems(): array {
        return $this->items->getValues();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    private function getCartItemForProduct(Product $product): ?CartItem {
        foreach ($this->items->getValues() as $item) {
            /** @var CartItem $item */
            if($item->getProduct()->getSku() === $product->getSku()) {
                return $item;
            }
        }

        return null;
    }

    protected function createNewCartItemLine(): CartItem
    {
        $line = new CartItem();
        return $line;
    }
}