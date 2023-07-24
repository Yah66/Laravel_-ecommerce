<div>
    <div wire:ignore.self id="payment_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen" style="">
            <div class="modal-content text-center">
                <div class="modal-header py-5 text-center">
                    <h2 class="modal-title text-center">
                        Payment
                    </h2>
                    <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form id="payment-form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input wire:model="name" type="text" class="form-control form-control-solid"
                                    placeholder="Name" />
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input wire:model="card_number" type="text"
                                    class="form-control form-control-solid card-number" placeholder="Card Number" />
                                @error('card_number')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cvc">CVC</label>
                                <input wire:model="CVC" type="text" class="form-control form-control-solid card-cvc"
                                    placeholder="CVC" />
                                @error('CVC')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expiration_month">Expiration Month</label>
                                <input wire:model="expiration_month" type="text"
                                    class="form-control form-control-solid card-expiry-month"
                                    placeholder="Expiration Month" />
                                @error('expiration_month')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expiration_year">Expiration Year</label>
                                <input wire:model="expiration_year" type="text"
                                    class="form-control form-control-solid card-expiry-year"
                                    placeholder="Expiration Year" />
                                @error('expiration_year')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" wire:click="processPayment()" class="btn btn-primary mr-2">Pay Now
                            </button>
                            <button type="button" wire:click="cancel()" class="btn btn-secondary" data-dismiss="modal">
                                {{ __('messages.close') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @section('scripts')
        <!-- Include the JavaScript section -->
        <script>
            document.addEventListener('livewire:load', function() {
                var stripe = Stripe(
                    'pk_test_51MQUBJEMpznZbQtfnEc0fWG4oDVKjjaii4AYyQazxEyNgYo7x3v05XyzVkq9Fvvlsk1mWfg13p1S1KLnTBAS5Fly00eyjWf8xJ'
                    ); // Replace with your Stripe public key
                var elements = stripe.elements();

                // Create the Card Element and mount it to the card-element div
                var cardElement = elements.create('card');
                cardElement.mount('#card-element');

                // Handle real-time validation errors on the Card Element
                cardElement.addEventListener('change', function(event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });

                // Handle form submission and card tokenization
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            // Show any errors that occur during tokenization
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            // Tokenization was successful, set the token value to the Livewire component
                            Livewire.emit('tokenCreated', result.token.id);
                        }
                    });
                });
            });
        </script>
    @endsection
</div>
