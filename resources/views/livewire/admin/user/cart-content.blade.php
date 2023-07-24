
<div>
    <div class="d-flex flex-column-fluid">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('admin.includes.alerts.success')
                    <div class="card">
                        <div class="card-header">Cart</div>
                        <div class="card-body">
                            @include('livewire.admin.user.payment_gate')

                            @if (isset($carts))
                                <div class="cart-items">
                                    @foreach ($carts as $cart)
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <img src="{{ asset('storage/' . $cart->image) }}"
                                                    alt="{{ $cart->name }}" class="img-fluid cart-item-image">
                                            </div>
                                            <div class="col-md-9">
                                                <h4>{{ $cart->name }}</h4>
                                                <p>Price: ${{ $cart->price }}</p>
                                                <p>Quantity: {{ $cart->qty }}</p>
                                                <p>Total: ${{ $cart->price }}</p>
                                                <button class="btn btn-danger remove-button"
                                                    wire:click="removeFromCart({{ $cart->id }})">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="cart-summary">
                                    <h4>Cart Summary</h4>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>Total: </p>
                                        </div>
                                        <div class="col-md-2">
                                            <p>${{ $total_price }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p> </p>
                                        </div>

                                    </div>
                                    <button class="btn btn-primary place-order-button" wire:click="cach_order">Cach
                                        Order</button>

                                    {{-- <a class="btn btn-success place-order-button" ata-toggle="modal"
                                data-target="#payment_modal">Place
                                payment </a> --}}

                                    <a wire:click="openModal()" class="btn btn-primary font-weight-bolder"
                                        data-toggle="modal" data-target="#payment_modal">
                                        <i class="la la-plus"></i>
                                        Place Payment {{$total_price}}
                                    </a>
                                </div>
                            @else
                                <p>No items in the cart.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>















