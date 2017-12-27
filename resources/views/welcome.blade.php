<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cart</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <style media="screen">
            #page {
                margin: 40px;
            }
            ul  {
                list-style: none;
            }
            li {
                padding: 20px;
                border: 1px solid #bdbdbd;
            }
        </style>
    </head>
    <body>
        <div class="container" id="page">
            <div class="row">
                <div class="col-md-6" id="items">
                    <h3 class="text-center">Items</h3>

                    <ul>
                        @if(count($items))
                            @foreach($items as $item)
                                <li data-id={{$item->getId()->toString()}}>
                                    <span data-type="name{{$item->getId()->toString()}}">
                                        {{$item->getName()}}
                                    </span>
                                    <span data-type="price{{$item->getId()->toString()}}">
                                        ${{$item->getPrice()}}
                                    </span>
                                    @if($item->getSale())
                                        <span class="text-danger">*on sale</span>
                                    @endif
                                    <a href="#" data-type="cart" class="btn btn-sm btn-primary">cart</a>
                                    <a href="#" data-type="wishlist" class="btn btn-sm btn-info">wishlist</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>


                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12" id="cart" data-id="">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="text-center">Cart</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="emptycart btn btn-danger" data-type="cart">
                                        Empty Cart
                                    </a>
                                </div>
                            </div>
                            <ul>
                                <li>Loading...</li>
                            </ul>
                        </div>
                        <div class="col-md-12" id="wishlist" data-id="">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="text-center">Wishlist</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="emptycart btn btn-danger" data-type="wishlist">
                                        Empty Wishlist
                                    </a>
                                </div>
                            </div>
                            <ul>
                                <li>Loading...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
        <script type="text/javascript">
            $("#items li a").on('click', function(){
                var item_id = $(this).closest('li').data('id');
                var item_name = $(`span[data-type="name${item_id}"]`).html();
                var item_price = $(`span[data-type="price${item_id}"]`).html();
                var item_type = $(this).data('type');
                var cart_id = $(`#${item_type}`).data('id');
                console.log(cart_id);

                if ($(`#${item_type} ul li`).hasClass('empty')) {
                    $(`#${item_type} ul`).html('');
                }

                $(`#${item_type} ul`).append(`<li data-id=${item_id}>
                                                <h5>
                                                    <span>${item_name}</span>
                                                    <small>${item_price}</small>
                                                    <a href="#" data-type="delete" class="btn btn-sm btn-danger">remove</a>
                                                </h5>
                                            </li>`);

                addItem(item_id, cart_id);
            });

            $("ul").on('click', "a[data-type='delete']", function () {
                var item_id = $(this).closest('li').data('id');
                var cart_id = $(this).closest('div').data('id');
                $(this).closest('li').remove();
                removeItem(item_id,cart_id);
            });

            $("a").on('click', function () {
                if ($(this).hasClass('emptycart')) {
                    var cart_type = $(this).data('type');
                    var cart_id = $(`#${cart_type}`).data('id');

                    $(`#${cart_type} ul`).html('<li class="empty">Your cart is empty</li>')

                    emptyCart(cart_id);
                }
            });

            $(document).ready(function () {

                if (readCookie("cart") != null && readCookie("wishlist") != null ) {
                    //populate cart items
                    getCart(readCookie("cart"),0);
                    getCart(readCookie("wishlist"),1)
                } else {
                    //create new cart
                    createCart(0);
                    createCart(1);
                }
            });


        </script>
    </body>
</html>
