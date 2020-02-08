<?php

declare(strict_types=1);

namespace App\Domain\Model;

class Product
{
    protected int $id;
    protected string $title;
    protected float $price;

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