<?php

namespace App\Http\Livewire\Admin\Userpage;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product_id;
    public $quantity;

    public function render()
    {
        $product = Product::find($this->product_id);
        // dd($product->name);
        return view('livewire.admin.userpage.show-product', [
            'product' => $product
        ])->extends('front.home')->section('content');
    }

    public function mount($id)
    {
        $this->product_id = $id;
    }

    public function add_to_cart($id)
    {
        $product  = Product::find($id);
        $user = Auth::user();
        $price = $product->discount_price ?? $product->price;
        // dd($price *  $this->quantity);

        if ($this->quantity > 0 && $this->quantity <= $product->qty) {
            // $cart = Cart::create([
            //     'user_id' => $user->id,
            //     'user_name' => $user->name,
            //     'email' => $user->email,
            //     'phone' => $user->phone,
            //     'address' => $user->address,
            //     'price' => $price * $this->quantity,
            //     'qty' => $this->quantity,
            //     'title' => $product->name,
            //     'image' => $product->image,

            // ]);

            $cart = Cart::create([
                'user_id' => 1,
                'user_name' => 'ahmed',
                'email' => 'yahiahlaby12@gmail.com',
                'phone' => '0592418862',
                'address' => '',
                'price' => $price,
                'qty' => $this->quantity,
                'product_title' => $product->name,
                'product_id' => $product->id,
                'image' => $product->image,

            ]);
         
            return redirect()->back()->with('message', 'Product added to cart successfully ..');;
        } else {
            return redirect()->back()->with('message', 'there is no enough qty');
        }
    }
}