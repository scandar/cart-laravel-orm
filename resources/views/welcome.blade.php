@extends('layout')
@section('title')
    Cart
@endsection
@section('content')
    <a href="{{route('items.index')}}" class="btn btn-primary">
        Manage Items
    </a>
    <div class="row">
                <div class="col-md-6" id="items">
                    <h3 class="text-center">Items</h3>

                    <ul>
                        @if(count($items))
                            @foreach($items as $item)
                                <li data-id={{$item->getId()->toString()}}>
                                    <span class="row">
                                        <span class="col-md-6">
                                            <span data-type="name{{$item->getId()->toString()}}">
                                                {{$item->getName()}}
                                            </span>
                                            <span data-type="price{{$item->getId()->toString()}}">
                                                ${{$item->getPrice()}}
                                            </span>
                                            @if($item->getSale())
                                            <span class="text-danger">*on sale</span>
                                            @endif
                                        </span>

                                        <span class="col-md-6">
                                            <a href="#" data-type="cart" class="btn btn-sm btn-primary">cart</a>
                                            <a href="#" data-type="wishlist" class="btn btn-sm btn-info">wishlist</a>
                                        </span>
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li>
                                No items,
                                <a href="{{route('items.create')}}" class="btn btn-primary">
                                    create a new item
                                </a>
                            </li>
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
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/functions.js')}}"></script>
    <script type="text/javascript">
            $("#items li a").on('click', function(){
                var item_id = $(this).closest('li').data('id');
                var item_name = $(`span[data-type="name${item_id}"]`).html();
                var item_price = $(`span[data-type="price${item_id}"]`).html();
                var item_type = $(this).data('type');
                var cart_id = $(`#${item_type}`).data('id');

                if ($(`#${item_type} ul li[data-id="${item_id}"]`).length == 0) {

                    if ($(`#${item_type} ul li`).hasClass('empty')) {
                        $(`#${item_type} ul`).html('');
                    }

                    $(`#${item_type} ul`).append(`<li data-id=${item_id}>
                        <h5>
                        <span class="row">
                        <span class="col-md-6">
                        <span>${item_name}</span>
                        <small>${item_price}</small>
                        </span>
                        <span class="col-md-6">
                        <a href="#" data-type="delete" class="btn btn-sm btn-danger">remove</a>
                        </span>
                        </span>
                        </h5>
                        </li>`);

                        addItem(item_id, cart_id);
                } else {
                    alert("Can't add item twice");
                }

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
@endsection
