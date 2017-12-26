<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Item\Item;
use App\Domain\Cart\Cart;
use App\Domain\ItemCart\ItemCart;
use App\Domain\Item\ItemRepository;
use App\Domain\Cart\CartRepository;
use App\Domain\ItemCart\ItemCartRepository;
use App;

class ItemCartRepositoryTest extends TestCase
{
    protected $repository;
    protected $cart;
    protected $item;
    protected static $item_cart;
    protected static $_item;
    protected static $_cart;

    public function setUp()
    {
        parent::setUp();
        $this->repository = App::make(ItemCartRepository::class);
        $this->cart = App::make(CartRepository::class);
        $this->item = App::make(ItemRepository::class);
    }

    public function testCreateAndSave()
    {
        $item = $this->item->create(['name' => 'item','price'=>1.99]);
        $cart = $this->cart->create(['token' => 'iowj1oih13112ssq','wishlist'=>0]);
        $data = [
          'cart' => $cart,
          'item' => $item
        ];

        $item_cart = $this->repository->create($data);
        self::$item_cart = $this->repository->save($item_cart);
        self::$_item = self::$item_cart->getItem();
        self::$_cart = self::$item_cart->getCart();
        $this->assertDatabaseHas('item_cart', ['id'=>self::$item_cart->getId()]);
    }

    public function testUpdateAndSave()
    {
        $item = $this->item->create(['name' => 'itemupdate','price'=>2.99]);
        $cart = $this->cart->create(['token' => 'iowj1oih13112ssq','wishlist'=>0]);
        $data = [
          'cart' => $cart,
          'item' => $item
        ];

        $item_cart = $this->repository->update($data, self::$item_cart->getId());

        self::$item_cart = $this->repository->save($item_cart);
        $item_cart = $this->repository->update($data, self::$item_cart->getId());

        self::$item_cart = $this->repository->save($item_cart);
        self::$_item = self::$item_cart->getItem();
        self::$_cart = self::$item_cart->getCart();


        $this->assertEquals(self::$_cart, self::$item_cart->getCart());
        $this->assertEquals(self::$_item, self::$item_cart->getItem());
    }

    public function testFindAll()
    {
        $items = $this->repository->findAll();

        $this->assertContainsOnlyInstancesOf(ItemCart::class, $items);
    }

    public function testDelete()
    {
        $item = $this->repository->find(self::$item_cart->getId());

        $result = $this->repository->delete($item);

        $this->assertTrue($result);
    }
}
