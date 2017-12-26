<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;
use App\ItemCart;

class CartController extends Controller
{
    protected $repository;
    protected $cart;
    protected $item;
    protected $item_cart;


    public function __construct()
    {
        $this->cart = new Cart;
        $this->item = new Item;
        $this->item_cart = new ItemCart;
    }

    public function index()
    {
        // $item = $this->item->repository->find('b73a9a43-0a99-43d8-a33b-45dba4114b43');
        // dd($item);
        // $cart = $this->cart->repository->create(['token'=>'dwqedwqewqrqeww','wishlist'=>'0']);
        // $cart = $this->cart->repository->save($cart);
        // return $item_cart->getCart()->getToken();
        // $this->cart->repository->save($cart);
    }
}
