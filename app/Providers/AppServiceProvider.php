<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Cart\Cart;
use App\Domain\Cart\CartRepository;
use App\Infrastructure\Cart\DoctrineCartRepository;
use App\Domain\Item\Item;
use App\Domain\Item\ItemRepository;
use App\Infrastructure\Item\DoctrineItemRepository;
use App\Domain\ItemCart\ItemCart;
use App\Domain\ItemCart\ItemCartRepository;
use App\Infrastructure\ItemCart\DoctrineItemCartRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //  NOT USING A LOOP BECAUSE OF ERROR:
        //  PHP Fatal error:  Dynamic class names are not allowed in compile-time ::class
        //  REGISTERNIG STATICALLY TILL I FIGURE IT OUT 

        $this->app->bind(CartRepository::class, function($app) {
          // This is what Doctrine's EntityRepository needs in its constructor.
          return new DoctrineCartRepository(
              $app['em'],
              $app['em']->getClassMetaData(Cart::class)
          );
        });

        $this->app->bind(ItemRepository::class, function($app) {
          // This is what Doctrine's EntityRepository needs in its constructor.
          return new DoctrineItemRepository(
              $app['em'],
              $app['em']->getClassMetaData(Item::class)
          );
        });

        $this->app->bind(ItemCartRepository::class, function($app) {
          // This is what Doctrine's EntityRepository needs in its constructor.
          return new DoctrineItemCartRepository(
              $app['em'],
              $app['em']->getClassMetaData(ItemCart::class)
          );
        });
    }
}
