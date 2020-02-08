<?php

declare(strict_types=1);

namespace App\Entity;

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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    protected string $title;

    /**
     * @ORM\Column(type="float", name="price")
     */
    protected float $price;
}