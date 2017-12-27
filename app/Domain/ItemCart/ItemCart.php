<?php
namespace App\Domain\ItemCart;

/**
*   ItemCart Entity
*   Contains entity getters and setters
*/
class ItemCart
{
    protected $id;
    protected $cart_id;
    protected $item_id;
    protected $cart;
    protected $item;

    public function getId()
    {
        return $this->id;
    }

    public function getCartId()
    {
        return $this->cart_id;
    }

    public function setCartId($cart_id)
    {
        $this->cart_id = $cart_id;
    }

    public function getItemId()
    {
        return $this->item_id;
    }

    public function setItemId($item_id)
    {
        $this->item_id = $item_id;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }


    public function getItem()
    {
        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
    *   entity columns whitelist
    *   used on saving to database
    */
    public function whitelist()
    {
        return [
            'cart_id',
            'item_id',
            'cart',
            'item',
        ];
    }
}
