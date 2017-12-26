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

    public function whitelist()
    {
        return [
            'name',
            'price'
        ];
    }
}
