<?php
namespace App\Infrastructure\ItemCart;

use App\Domain\ItemCart\ItemCartRepository;
use App\Infrastructure\DoctrineBaseRepository;
use App\Domain\Cart\Cart;

class DoctrineItemCartRepository extends DoctrineBaseRepository implements ItemCartRepository
{


}
