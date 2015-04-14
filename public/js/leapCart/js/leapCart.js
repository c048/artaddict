$(document).ready(function() {

    var cartLocked = false;
    var prodLocked = false;
    var url = "http://www.artaddict.eu/public/js/leapCart/";
    var siteUrl = "http://www.artaddict.eu/";
    var url_helpers = "http://www.artaddict.eu/utils/";
    
//    var url = "http://localhost/artaddict/public/js/leapCart/";
//    var siteUrl = "http://localhost/artaddict/";
//    var url_helpers = "http://localhost/artaddict/utils/";
    
    init();

    function init() {
        this.cartPrefix = "artaddict-";
        this.cartName = this.cartPrefix + "cart";
        this.storage = sessionStorage;
        
        createCart();
        
        loadCSS(url + 'css/style.css');
        loadHTML(url + 'cart.html');
    };
    
    function _formatCurrency(str) {
        var sParts = "";
        
        if(str.search(/\./)) {
            sParts = str.split(/\./);
        } else { 
            sParts[0] = str;
        }
        
        var fParts = sParts[0].split(".");
        fParts[0] = fParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        
        if(typeof sParts[1] == 'undefined') {
            return (fParts.join("."));
        }
        else {
            return (fParts.join(".") + "," + sParts[1]);
        }
    };

    function createCart() {
        if (this.storage.getItem(this.cartName) == null) {
            var cart = {};
            cart.items = [];
            cart.qty=0;
            cart.total=0;

            this.storage.setItem(this.cartName, _toJSONString(cart));
        }
    };

    function checkCart(itemId) {
        var cart = _toJSONObject(this.storage.getItem(this.cartName));
        var items = cart.items;
        var detected = 0;
        
        for (var i = 0; i < items.length; ++i) {
            var item = items[i];
            if (item.id == itemId){
                detected = 1;
            }
        }
        
        return detected;
    }
    
    // Updates the UI price & Quantity
    function updateUI() {
        var cart = _toJSONObject(this.storage.getItem(this.cartName));
        var qty = cart.qty;
        var total = _convertNumber(cart.total);
        
        if(qty==0) {
            $("#cart_header_shortItems img").attr("src", url + "assets/images/iconCartEmpty.png");
            $("#cart_header_shortItems .cart_comment").text('');
            cartLocked=true;
            $("#cart_wrapper").css("position","fixed");
            $('#cart_panels').slideUp(400);
        } else {
            $("#cart_header_shortItems img").attr("src", url + "assets/images/iconCartFull.png");
            cartLocked=false;
            if (!($('#cart_panels').is(':visible'))) {
                $("#cart_header_shortItems .cart_comment").text('Click to show cart');
            };
        }
        
        $(".cart_qty").text('Items in cart: ' + qty + ' ');
        $(".cart_total").text('Total: € ' + _formatCurrency(total));
    }
    
    // Sets the hide or show text on cart toggling
    function cartToggleUI() {
        if ($('#cart_panels').is(':visible')) {
            $("#cart_header_shortItems .cart_comment").text('Click to show cart');
        } else {
            $("#cart_header_shortItems .cart_comment").text('Click to hide cart');
        };
        
        if(($('#cart_panels').css('display'))=='none') {
            $('html,body').animate({ scrollTop: 0 }, 400, function(){
                $("#cart_wrapper").css("position","absolute");
            });
        } else {
            $("#cart_wrapper").css("position","fixed");
        };
    }

    /* Converts a numeric string into a number
     * @param numStr String the numeric string to be converted
     * @returns num Number the number
     */
    function _convertString(numStr) {
        var num;
        if (/^[-+]?[0-9]+\.[0-9]+$/.test(numStr)) {
            num = parseFloat(numStr);
        } else if (/^\d+$/.test(numStr)) {
            num = parseInt(numStr, 10);
        } else {
            num = Number(numStr);
        }

        if (!isNaN(num)) {
            return num;
        } else {
            console.warn(numStr + " cannot be converted into a number");
            return false;
        }
    };

    /* Converts a number to a string
     * @param n Number the number to be converted
     * @returns str String the string returned
     */
    function _convertNumber(n) {
        var str = n.toString();
        return str;
    };

    /* Converts a JSON string to a JavaScript object
     * @param str String the JSON string
     * @returns obj Object the JavaScript object
     */
    function _toJSONObject(str) {
        var obj = JSON.parse(str);
        return obj;
    };

    /* Converts a JavaScript object to a JSON string
     * @param obj Object the JavaScript object
     * @returns str String the JSON string
     */
    function _toJSONString(obj) {
        var str = JSON.stringify(obj);
        return str;
    };
    
    // updates the cart
    function updateCart(itemId, itemMod) {
        var self = this;
        var cart = _toJSONObject(this.storage.getItem(this.cartName));
        var items = cart.items;
        
        var updatedQty = 0;
        var updatedTotal = 0;
        var updatedCart = {};
        
        if(typeof(itemMod)==='undefined') itemMod = 'add';
        updatedCart.items = [];
        
        for (var i = 0; i < items.length; ++i) {
            var item = items[i];
            var qty=_convertString(item.qty);
            if( item.id == itemId && itemMod == 'add') {
                ++qty;
            } else if( item.id == itemId && itemMod == 'sub') {
                --qty;
            }
            
            var cartObj = {
                id: _convertString(item.id),
                product: item.product,
                image: item.image,
                price: _convertString(item.price),
                qty: qty
            };
            
            if( !(itemId==item.id && itemMod== 'del') && (qty > 0) ) {
                updatedCart.items.push( cartObj );
                var subTotal = qty * _convertString(item.price);
                updatedTotal += subTotal;
                updatedQty += qty;
            }
            
            updatedCart.total = updatedTotal;
            updatedCart.qty = updatedQty;
        }
        
        self.storage.setItem( self.cartName, _toJSONString( updatedCart ) );
    };

    /* Add an object to the cart as a JSON string
     * @param values Object the object to be added to the cart
     * @returns void
     */
    function addToCart(values) {
        var cart = this.storage.getItem(this.cartName);
        var cartCopy = _toJSONObject(cart);
        var items = cartCopy.items;
        var totPrice = cartCopy.total + values.price;
        var totQty = ++cartCopy.qty;
        
        items.push(values);
        cartCopy.total = totPrice;
        cartCopy.qty = totQty;
        
        this.storage.setItem(this.cartName, _toJSONString(cartCopy));
    };

    // Renders the shopping cart
    function displayCart() {
        var cart = _toJSONObject(this.storage.getItem(this.cartName));
        var items = cart.items;
        var $tableCart = $("#list_items");
        
        $tableCart.empty();
        for (var i = 0; i < items.length; ++i) {
            var item = items[i];
            var product = item.product;
            var id = item.id;
            var image = item.image;
            var price = item.price;
            var qty = item.qty;
            var total = _convertNumber(qty*price);
            var html = "<div class='cart_item'>";
            
            html += "<div class='cart_item_img'><img src='" + image + "'/></div><div class='cart_item_descr' data-id='" + id + "' data-name='" + product + "' data-price=" + price + " data-img='" + image + "'><p>" + qty + " x " + product + " ";
            html += '<span class="cart_item_tools hidden"><img class="item_tools_decrease" src="' + url + 'assets/images/iconDecrease0.png" onmouseover="this.src=\'' + url +  'assets/images/iconDecrease1.png\';" onmouseout="this.src=\'' + url + 'assets/images/iconDecrease0.png\';" title="Decrease quantity"><img class="item_tools_remove" src="' + url + 'assets/images/iconDelete0.png" onmouseover="this.src=\'' + url + 'assets/images/iconDelete1.png\';" onmouseout="this.src=\'' + url + 'assets/images/iconDelete0.png\';" title="Remove item"><img class="item_tools_increase" title="Increase quantity" src="' + url + 'assets/images/iconIncrease0.png" onmouseover="this.src=\'' + url + 'assets/images/iconIncrease1.png\';" onmouseout="this.src=\'' + url + 'assets/images/iconIncrease0.png\';" ></span>';
            html += "</div>";
            html += "<div class='cart_item_price'>Price  <span class='span_right'>€ " + _formatCurrency(total) + "</span></div>";
            html += "</div>";

            $tableCart.append(html).fadeIn('fast');
        }
    };
    
    // Empties the cart
    function emptyCart() {
        this.storage.removeItem(this.cartName);
    };
    
    // Renders the default panel and hides the others
    function showDefault() {
        $("#cart_panel_items").show();
        $("#cart_panel_checkout").hide();
        $("#cart_panel_message").hide();
    };
    
    // Loads designated HTML into the page
    function loadHTML(cartPage) {
        $.get(cartPage, function(newBlock) {
            jQuery('body').prepend(newBlock);
            showDefault();
            updateUI();
        });
    };
    
    // Loads designated CSS into the page
    function loadCSS(href) {
        var cssLink = $("<link rel='stylesheet' type='text/css' href='" + href + "'>");
        $("head").append(cssLink);
    };
    
    /* Fades first element out and fades second element in
     * @param fadeOutElement String the element that is faded out
     * @param fadeInElement String the element that is faded in
     */
    function slowTransition(fadeOutElement, fadeInElement) {
        if (fadeOutElement == 'undefined' || fadeInElement == 'undefinded') {
            console.log('Error: unable to perform transition due to parameter error.');
            return 0;
        } 
        
        $(fadeOutElement).fadeOut(500, function() {
          $(fadeInElement).fadeIn(500);  
        });
    }
    
    // Handles cart toggle animation
    function cartToggle() {
        if(!cartLocked) {
            cartToggleUI();
        }
        
        if(!cartLocked) {
            cartLocked=true;
            $('#cart_panels').slideToggle(400, function() {
                cartLocked=false;
                if ($('#cart_panels').is(':hidden') && $('#cart_panel_items').is(':hidden')) {
                    showDefault();
                }
            });
        }
    }
    
    /* Checks the input of the user detail form
     * @param clientForm String id or class of the form
     * returns string with validation information
     */
    function validateCheckout(clientForm) {
        var visibleFields = $(clientForm).find( ".form_checkout_field input" );
        var requiredFields = {expression: {value: /^([\w-\.]+)@((?:[\w]+\.)+)([a-z]){2,4}$/ }, str: {value: ""}};
        var fieldError = "validated";
        
        visibleFields.each(function() {
            var input = $(this);
            var type = input.data("type");
            
            if(!(input.attr('name') == 'company')) {
                if( type == "string" ) {
                    if (input.val() == requiredFields.str.value) {
                        fieldError = input.attr('name');
                        return false;
                    };
                } else {
                    if (!requiredFields.expression.value.test(input.val())){
                        fieldError = input.attr('name');
                        return false;
                    }
                }
            }
        });
        
        return(fieldError);
    }
    
    /* Blinks a red warning background 2 times
     * @param htmlElement String id or class of the element
     */
    function warningAni(htmlElement) {
        var i = 0;
        var warning = setInterval(function(){
            if(i<4) {
                $(htmlElement).toggleClass("backgroundRed");
                ++i;
            } else {
                clearInterval(warning);
            }
        },200);
    }
    
    /* Animate the image following a product button click
     * @param values Object the img url, width, height, top and left position
     * @param callback code that needs to be exectured after the animation has ended
     */
    function productImgAni(values, callback) {
        $("#cart_header").append('<img id="product_img_animated" style="left:' + values.left + 'px; top:' + (values.top-($(window).scrollTop())) + 'px;" src="' + values.url + '" />');
        $("#product_img_animated").width(values.width);
        $("#product_img_animated").height(values.height);
        var cartLoc = $("#cart_header_shortItems img").position();
        
        $("#product_img_animated").animate({left:((cartLoc.left)), top:((cartLoc.top)), width:(values.width*(26/values.width)), height:(values.height*(26/values.height))});
        $("#product_img_animated").animate({left:((cartLoc.left)+12), top:((cartLoc.top)+12), width:1, height:1}, function(){
            $('#product_img_animated').remove();
            if (typeof callback == 'function') {
                callback.call(this);
            }
        });
    }
    
    function getCart() {
        var cart = _toJSONObject(this.storage.getItem("artaddict-cart"));
        var items = cart.items;
        var carItems = [];

        for (var i = 0; i < items.length; ++i) {
            var item = items[i];
            var id = item.id;
            var qty = item.qty;
            var data = [];
            
            data[0] = id;
            data[1] = qty;
            carItems[i] = data;
        }
        
        return carItems;
    }
    
    // Handles item tools
    $('body').on({
        mouseenter: function () {
            $(this).children(".cart_item_descr").children("p").children(".cart_item_tools").removeClass("hidden");
        },
        mouseleave: function () {
            $(this).children(".cart_item_descr").children("p").children(".cart_item_tools").addClass("hidden");
        }
    }, ".cart_item");
    
    // Handles cart toggling interaction
    $('body').on('click', '#cart_header', function() {
        displayCart();
        cartToggle();
        updateUI();
    });
    
    // Handles empty button
    $('body').on('click', '#btn_list_empty', function() {
        if(!cartLocked) {
            emptyCart();
            createCart();
            cartToggleUI();
            updateUI();
        }
    });
    
    // Handles hide button
    $('body').on('click', '#btn_list_hide', function() {
        cartToggle();
    });
    
    // Handles goto checkout btn
    $('body').on('click', '#btn_list_checkout', function() {
        slowTransition("#cart_panel_items", "#cart_panel_checkout");
    });
    
    // Go from checkout back to items
    $('body').on('click', '#btn_checkout_return', function() {
        slowTransition("#cart_panel_checkout", "#cart_panel_items");
    });

    // Checkout form subit button
    $('body').on('click', '#btn_checkout_submit', function() {
        var validation = validateCheckout("#cart_panel_checkout");
        
        if(validation!="validated") {
            var field = $('#form_checkout_fieldset').find('[name="' + validation + '"]');
            warningAni(field);
        } else {
            slowTransition("#cart_panel_checkout", "#cart_panel_message");
            $(".panel_message_text").text('Placing order...');
            
            var mailItems = getCart();
            console.log(mailItems);
            
            var request = $.ajax({url: siteUrl + "artists/xhrEmail", type: "POST", data: {
                form_name: $( "[name='name']" ).val(),
                form_surname: $( "[name='surname']" ).val(),
                form_company: $( "[name='company']" ).val(),
                form_address: $( "[name='address']" ).val(),
                form_zip: $( "[name='zip']" ).val(),
                form_city: $( "[name='city']" ).val(),
                form_country: $( "[name='country']" ).val(),
                form_email: $( "[name='email']" ).val(),
                form_phone: $( "[name='phone']" ).val(),
                form_msg: $( "[name='note']" ).val(),
                form_items: mailItems
            }, success: function(data){
            }});
        
            request.done(function(data) {
                if(data == 0) {
                    $(".panel_message_text").text('Your order has succesfully been placed.');
                    emptyCart();
                    createCart();
                } else {
                    $(".panel_message_text").text('We appologise, but we were unable to connect to our mail server. Please contact us directly at info@artaddict.eu');
                }
            });
            
            request.fail(function(jqXHR, errorMsg) {
                $(".panel_message_text").text('We appologise, but we were unable to connect to our mail server. Please contact us directly at info@artaddict.eu');
            });
        }
    });
    
    // Handles item tools deincrease
    $('body').on('click', '.item_tools_decrease', function() {
        var $product = $(this).parents(".cart_item_descr");
        updateCart($product.data('id'), 'sub');
        displayCart();
        updateUI();
    });
    
    // Handles item tools increase
    $('body').on('click', '.item_tools_increase', function() {
        var $product = $(this).parents(".cart_item_descr");
        updateCart($product.data('id'));
        displayCart();
        updateUI();
    });
    
    // Handles item tools removal
    $('body').on('click', '.item_tools_remove', function() {
        var $product = $(this).parents(".cart_item_descr");
        updateCart($product.data('id'), 'del');
        displayCart();
        updateUI();
    });
    
    
    // Handles product selection
    $('.eButtonProduct').on('click', function() {
        if( prodLocked==false ) {
            prodLocked = true; //prevents new products to be added via the buttonclick until the animation is done.
            
            var $product = $(this).parent().parent();
            var price = _convertString($product.data('price'));
            var prodImg = $(this).parents(".bContentProduct").children(".eProductImage").children("a").children(".product_image_thumb");
            var name = $product.data('name');
            var img = $product.data('thumb');
            var id = $product.data('id');
            var qty = 1;

            productImgAni({
                url: img, 
                top: prodImg.position().top, 
                left: prodImg.position().left, 
                width: prodImg.width(), 
                height: prodImg.height()
            }, function(){
                if(checkCart(id)) {
                    updateCart(id);
                } else {
                    addToCart({
                        id: _convertString(id),
                        product: name,
                        image: img,
                        price: price,
                        qty: qty
                    });
                }
                
                prodLocked = false;
                showDefault();
                displayCart();
                updateUI();
            });
        }
    });

});