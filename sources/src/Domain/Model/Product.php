<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Event\Exceptions\Model\BadModelDataException;

class Product implements ModelInterface
{
    protected string $sku;
    protected string $name;
    protected float $price;

    /**
     * @throws BadModelDataException
     */
    public function __construct(string $sku, string $name, float $price)
    {
        $this->affectSku($sku);
        $this->renameWith($name);
        $this->updatePrice($price);
    }

    /**
     * @throws BadModelDataException
     */
    private function affectSku(string $sku): void
    {
        if ('' === $sku) {
            throw new BadModelDataException($this, 'sku', 'Product sku can not be empty');
        }

        if (!preg_match('/^([A-Z]{4}-){3}(\d+)$/', $sku)) {
            throw new BadModelDataException($this, 'sku', 'Product sku should be format as XXXX-XXXX-XXXX-51');
        }

        $this->sku = $sku;
    }

    /**
     * @throws BadModelDataException
     */
    public function renameWith(string $name): Product
       {
        if ('' === $name) {
            throw new BadModelDataException($this, 'name', 'Product name can not be empty');
        }

        if(strlen($name) > 255) {
            throw new BadModelDataException($this, 'name', 'Product name should not contains more than 255 chars');
        }

        if(!preg_match('/^[_A-z0-9]*((-|\s)*[_A-z0-9])*$/', $name)) {
            throw new BadModelDataException($this, 'name', 'Product name should not contains special chars');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @throws BadModelDataException
     */
    public function updatePrice(float $price): Product
    {
        if(0 == $price) {
            throw new BadModelDataException($this, 'price', 'Product can not be free');
        }

        if(0 > $price) {
            throw new BadModelDataException($this, 'price', 'Product price can not be negative');
        }

        $this->price = $price;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}