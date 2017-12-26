<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Item\ItemRepository;
use App\Domain\Item\Item;
use App;

class ItemRepositoryTest extends TestCase
{
    protected $repository;
    protected static $item;

    public function setUp()
    {
        parent::setUp();
        $this->repository = App::make(ItemRepository::class);
    }

    public function testCreateAndSave()
    {
        $data = [
          'name' => 'foo',
          'price' => 1.99
        ];
        $item = $this->repository->create($data);
        self::$item = $this->repository->save($item);

        $this->assertDatabaseHas('items', ['id'=>self::$item->getId()]);
    }

    public function testUpdateAndSave()
    {
        $data = [
          'name' => 'bar',
          'price' => 2.99
        ];
        $item = $this->repository->update($data, self::$item->getId());
        self::$item = $this->repository->save($item);

        $this->assertEquals($data['name'], self::$item->getName());
        $this->assertEquals($data['price'], self::$item->getPrice());
    }

    public function testFindAll()
    {
        $items = $this->repository->findAll();

        $this->assertContainsOnlyInstancesOf(Item::class, $items);
    }

    public function testDelete()
    {
        $item = $this->repository->find(self::$item->getId());

        $result = $this->repository->delete($item);

        $this->assertTrue($result);
    }
}
