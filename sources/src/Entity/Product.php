<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    private string $title;

    /**
     * @ORM\Column(type="float", name="price")
     */
    private float $price;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}