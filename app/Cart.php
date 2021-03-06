<?php

namespace App;

use App\Domain\Cart\CartRepository;
use App\Infrastructure\Cart\DoctrineCartRepository;
use App;

class Cart extends DoctrineCartRepository
{
    /*
    *   instantiating repository
    */
    public function __construct()
    {
        $this->repository = App::make(CartRepository::class);
    }
}
