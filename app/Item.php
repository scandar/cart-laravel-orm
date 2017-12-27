<?php

namespace App;

use App\Domain\Item\ItemRepository;
use App\Infrastructure\Item\DoctrineItemRepository;
use App;

class Item extends DoctrineItemRepository
{
    /*
    *   instantiating repository
    */
    public function __construct()
    {
        $this->repository = App::make(ItemRepository::class);
    }
}
