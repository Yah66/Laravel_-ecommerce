<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class UserCart extends Component
{
    // public $carts;
    public $name;
    public $card_number;
    public $CVC;
    public $expiration_month;
    public $expiration_year;
    public $addPaymentInfo = false;
    public $stripeToken = '';
    // public $carts;
    public $total_price;
    protected $listeners = ['tokenGenerated' => 'processPayment'];

    protected $rules = [
        'name' => 'required',
        'card_number' => 'required',
        'CVC' => 'required',
        'expiration_month' => 'required',
        'expiration_year' => 'required',
    ];

    public function render()
    {
        // dd('sadsadasdsa');
        // $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', 1)->get();
        foreach ($carts as $cart) {
            $this->total_price += $cart->qty * $cart->price;
        }

        return view('livewire.admin.user.cart-content', [
            'carts' => $carts,
            'total_price' => $this->total_price,
        ])->extends('layouts.site')->section('content');
    }

    public function showCart()
    {
        $user_id = Auth::user()->id;
        $this->carts = Cart::where('user_id', $user_id)->get();
    }
    public function resetFields()
    {
        $this->reset(['name', 'card_number', 'CVC', 'expiration_month', 'expiration_year']);
    }
    public function cach_order()
    {
        // $user = Auth::user();
        // $userId = $user->id;
        // $data = Cart::where('user_id', $userId)->get();
        $data = Cart::where('user_id', 1)->get();
        // dd($data);
        foreach ($data as $data) {
            Order::Create(
                [
                    'name' => $data->name,
                    'phone' => $data->phone,
                    'email' => $data->email,
                    'address' => $data->address,
                    'image' => $data->image,
                    'price' => $data->price,
                    'user_id' => $data->user_id,
                    'product_title' => $data->product_title,
                    'product_id' => $data->product_id,
                    'payment_status' => 'cach on delivery',
                    'delivery_status' => 'processing',
                    'qty' => $data->qty,
                ]
            );

            $product = Product::find($data->product_id);
            $product->quantity -= $data->qty;
            $product->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
            return session()->flash('success', 'Payment Successfuly');
        }
    }
    public function openModal()
    {

        $this->resetFields();
        $this->addPaymentInfo = true;
    }
    // public function mount()
    // {
    //     $this->stripeToken = session('stripeToken');
    // }
    public function tokenCreated($token)
    {
        $this->stripeToken = $token;
    }
    public function processPayment()
    {
        $this->validate([
            'name' => 'required',
            'card_number' => 'required',
            'CVC' => 'required',
            'expiration_month' => 'required',
            'expiration_year' => 'required',
        ]);

        $stripeSecretKey = Config::get('services.stripe.secret');
        Stripe::setApiKey($stripeSecretKey);

        try {
            $customer = Customer::create([
                "email" => "yahiahlaby12@gmail.com",
                "name" => $this->name,
            ]);

            $charge = Charge::create([
                "amount" => $this->total_price * 100, // Stripe expects the amount in cents
                "currency" => "EUR",
                "customer" => $customer->id,
                "description" => "Payment for the order",
            ]);

            if ($charge->status === 'succeeded') {
                session()->flash('success', 'Payment Successfuly ');
            } else {
                session()->flash('error', 'Payment failed ');
            }

            // Clear the payment form inputs
            $this->reset([
                'name',
                'card_number',
                'CVC',
                'expiration_month',
                'expiration_year',
            ]);

            // Close the payment modal
            $this->emit('closeModal');
        } catch (\Exception $e) {
            // Log the error message for debugging
            // dd($e->getMessage());
            session()->flash('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        // Clear the payment form inputs
        $this->reset([
            'name',
            'card_number',
            'CVC',
            'expiration_month',
            'expiration_year',
        ]);
        $this->addPaymentInfo = false;

        // Close the payment modal
        $this->emit('closeModal');
    }
}