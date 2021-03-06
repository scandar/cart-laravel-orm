<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;
use App\ItemCart;

/*
*   Cart Controller
*   used for cart operations
*/

class CartController extends Controller
{
    //MODEL INSTANCES
    protected $cart;
    protected $item;
    protected $item_cart;

    /*
    *   instantiating models
    */
    public function __construct()
    {
        $this->cart = new Cart;
        $this->item = new Item;
        $this->item_cart = new ItemCart;
    }

    /*
    *   returns the welcomde view with items
    */
    public function index()
    {
        $items = $this->item->repository->findAll();
        return view('welcome', ['items' => $items]);
    }

    /*
    *   returns a cart by it's ID
    */
    public function getCartById($id)
    {
        try {
            $cart = $this->cart->repository->find($id);
        } catch (\Exception $e) {
            return response('not found', 404)
                    ->header('Content-Type', 'text/plain');
        }

        if ($cart != null) {
            $data = [
                'id' => $cart->getId()->toString(),
                'wishlist' => $cart->getWishlist(),
            ];
            return json_encode($data);
        }

        return response('not found', 404)
        ->header('Content-Type', 'text/plain');
    }

    /*
    *   returns all items assocciated with a single cart
    */
    public function getCartItems($id)
    {
        $data = [];

        try {
            $item_carts = $this->item_cart->repository
                ->findBy([
                    'cart_id' => $id,
                ]);
        } catch (\Exception $e) {
            return response('not found', 404)
                    ->header('Content-Type', 'text/plain');
        }

        foreach ($item_carts as $icart) {
            $data[$icart->getItem()->getId()->tostring()]['name'] = $icart->getItem()->getName();
            $data[$icart->getItem()->getId()->tostring()]['price'] = $icart->getItem()->getPrice();
        }
        return json_encode($data);
    }

    /*
    *   creates a new cart and return it
    */
    public function create(Request $request)
    {
        $cart = $this->cart->repository->create(['wishlist'=>$request->wishlist]);
        $cart = $this->cart->repository->save($cart);

        $data = [
            'id' => $cart->getId()->toString(),
            'wishlist' => $cart->getWishlist(),
        ];
        return json_encode($data);
    }

    /*
    *   creates a new items_cart record
    */
    public function addItemCart(Request $request)
    {
        try {
            $cart = $this->cart->repository->find($request->cart_id);
            $item = $this->item->repository->find($request->item_id);
        } catch (\Exception $e) {
            return response('not found', 404)
                    ->header('Content-Type', 'text/plain');
        }

        $item_cart = $this->item_cart->repository->create([
            'item' => $item,
            'cart' => $cart
        ]);

        $item_cart = $this->item_cart->repository->save($item_cart);

        return response('success', 200)
                ->header('Content-Type', 'text/plain');
    }

    /*
    *   removes an item_cart record
    */
    public function destroyItemCart(Request $request)
    {
        try {
            $item_cart = $this->item_cart->repository->findOneBy([
                'cart_id' => $request->cart_id,
                'item_id' => $request->item_id,
            ]);
        } catch (\Exception $e) {
            return response('not found', 404)
                    ->header('Content-Type', 'text/plain');
        }

        $this->item_cart->repository->delete($item_cart);
        return response('success', 200)
                ->header('Content-Type', 'text/plain');
    }

    /*
    *   removes all items associated with a single cart
    */
    public function emptyCart(Request $request)
    {
        try {
            $item_carts = $this->item_cart->repository->findBy([
                'cart_id' => $request->cart_id,
            ]);
        } catch (\Exception $e) {
            return response('not found', 404)
                    ->header('Content-Type', 'text/plain');
        }

        foreach ($item_carts as $icart) {
            $this->item_cart->repository->delete($icart);
        }

        return response('success', 200)
                ->header('Content-Type', 'text/plain');
    }
}
