


<div class="_desktop_cart">
    <a  href="{{ route('user.show-cart') }}" id="_mobile_cart_bottom" class="nov-toggle-page" data-target="#mobile-blockcart">
        <div class="blockcart cart-preview active"
            data-refresh-url="//demo.bestprestashoptheme.com/savemart/ar/module/ps_shoppingcart/ajax">
            <div class="header-cart">
                <div class="cart-left">
                    <div class="shopping-cart"><i class="zmdi zmdi-shopping-cart"></i></div>
                    <div class="cart-products-count">{{ App\Models\Cart::count() }}</div>
                </div>
                <div class="cart-right d-flex flex-column align-self-end ml-13">
                    <span class="title-cart">سلة الشراء</span>
                    <span class="cart-item"> items</span>
                </div>
            </div>
            <div class="cart_block ">
                <div class="cart-block-content">
                    <div class="no-items">
                        No products in the cart
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
