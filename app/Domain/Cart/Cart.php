<?php
namespace App\Domain\Cart;

use App\Domain\Item\Item;

class Cart
{
    protected $id;
    protected $wishlist;

    public function getId()
    {
        return $this->id;
    }

    public function getWishlist()
    {
        return $this->wishlist;
    }

    public function setWishlist($bool)
    {
        $this->wishlist = $bool;
    }

    public function whitelist()
    {
        return [
            'wishlist'
        ];
    }
}
