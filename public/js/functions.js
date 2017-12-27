function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function getCart(id,wshlst) {
    $.ajax({
       type: 'GET',
       url: `/cart/${id}`,
   }).done(function(data){
       data = JSON.parse(data);

       if (data.wishlist) {
           $("#wishlist").data("id", data.id);
           createCookie("wishlist",data.id,10);
       } else {
           $("#cart").data("id", data.id);
           createCookie("cart",data.id,10);
       }
       populateCart(data.id,data.wishlist);
   }).fail(function () {
       createCart(wshlst);
   });
}

function populateCart(id,wishlist) {
    if (wishlist == 1 || wishlist == true) {
        var cart_id = "#wishlist ul";
    } else {
        var cart_id = "#cart ul";
    }
    $.ajax({
       type: 'GET',
       url: `/cart/${id}/items`,
       success: function(data){
            var html = '';
            data = JSON.parse(data);

            $.each(data, function(id, data) {
                html += `<li data-id=${id}>
                            <h5>
                                <span class="row">
                                    <span class="col-md-6">
                                        <span>${data.name}</span>
                                        <small>${data.price}</small>
                                    </span>
                                    <span class="col-md-6">
                                        <a href="#" data-type="delete" class="btn btn-sm btn-danger">remove</a>
                                    </span>
                                </span>
                            </h5>
                        </li>`;
            });

            if (html == '') {
                html += '<li class="empty">Your cart is empty</li>';
            }
            $(cart_id).html(html);
       }
     });
}

function createCart(wishlist) {
    if (wishlist == 1) {
        var cart_id = "wishlist";
    } else {
        var cart_id = "cart";
    }
    $.ajax({
       type: 'POST',
       url: `/cart`,
       data: {
           wishlist: wishlist,
       },
       success: function(data){
            data = JSON.parse(data);
            $(`#${cart_id}`).data("id", data.id);
            createCookie(cart_id,data.id,10);
            populateCart(data.id,data.wishlist);
       }
     });
}

function addItem(item_id, cart_id) {
    $.ajax({
       type: 'POST',
       url: `/cart/itemcart`,
       data: {
           item_id: item_id,
           cart_id: cart_id,
       },
     });
}

function removeItem(item_id,cart_id) {
    $.ajax({
       type: 'DELETE',
       url: `/cart/itemcart`,
       data: {
           item_id: item_id,
           cart_id: cart_id,
       },
     });
}

function firstReq() {
    if (readCookie("cart") != null) {
        //populate cart items
        getCart(readCookie("cart"),false);
    } else {
        //create new cart
        createCart(0);
    }
    // secondReq()
}

function secondReq() {
    if (readCookie("wishlist") != null) {
        //populate cart items
        getCart(readCookie("wishlist"),true)
    } else {
        //create new cart
        createCart(1);
    }
}

function emptyCart(id) {
    $.ajax({
       type: 'post',
       url: `/cart/empty`,
       data: {
           cart_id: id,
       },
     });
}
