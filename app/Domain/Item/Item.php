<?php
namespace App\Domain\Item;

/**
 *
 */
class Item
{
    protected $id;
    protected $name;
    protected $price;
    protected $sale;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getSale()
    {
        return $this->sale;
    }

    public function setSale($sale)
    {
        $this->sale = $sale;
    }

    public function whitelist()
    {
        return [
            'name',
            'price',
            'sale',
        ];
    }
}
