<?php

namespace App;

use App\Domain\ItemCart\ItemCartRepository;
use App\Infrastructure\ItemCart\DoctrineItemCartRepository;
use App;

class ItemCart extends DoctrineItemCartRepository
{
    /*
    *   instantiating repository
    */
    public function __construct()
    {
        $this->repository = App::make(ItemCartRepository::class);
    }
}
