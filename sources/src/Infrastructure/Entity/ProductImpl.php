<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Model\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class ProductImpl extends Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", name="sku", unique=true)
     */
    protected string $sku;

    /**
     * @ORM\Column(type="string", name="name")
     */
    protected string $name;

    /**
     * @ORM\Column(type="float", name="price")
     */
    protected float $price;
}