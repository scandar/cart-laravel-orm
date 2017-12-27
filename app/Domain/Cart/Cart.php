<?php
namespace App\Domain\Cart;

use App\Domain\Item\Item;
/**
*   Cart Entity
*   Contains entity getters and setters
*/
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

    /**
    *   entity columns whitelist
    *   used on saving to database
    */
    public function whitelist()
    {
        return [
            'wishlist'
        ];
    }
}
