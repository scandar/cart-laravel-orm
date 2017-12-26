<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Cart\CartRepository;
use App\Domain\Cart\Cart;
use App;

class CartRepositoryTest extends TestCase
{
    protected $repository;
    protected static $cart;

    public function setUp()
    {
        parent::setUp();
        $this->repository = App::make(CartRepository::class);
    }

    public function testCreateAndSave()
    {
        $data = [
          'wishlist' => 0
        ];
        $cart = $this->repository->create($data);
        self::$cart = $this->repository->save($cart);

        $this->assertDatabaseHas('carts', ['id'=>self::$cart->getId()]);
    }

    public function testUpdateAndSave()
    {
        $data = [
          'wishlist' => 1
        ];
        $cart = $this->repository->update($data, self::$cart->getId());
        self::$cart = $this->repository->save($cart);

        $this->assertEquals($data['wishlist'], self::$cart->getWishlist());
    }

    public function testFindAll()
    {
        $carts = $this->repository->findAll();

        $this->assertContainsOnlyInstancesOf(Cart::class, $carts);
    }

    public function testDelete()
    {
        $cart = $this->repository->find(self::$cart->getId());

        $result = $this->repository->delete($cart);

        $this->assertTrue($result);
    }
}
