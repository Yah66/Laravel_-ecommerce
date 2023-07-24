<?php

namespace App\Http\Livewire\Admin\Userpage;

use App\Models\Cart;
use App\Models\MainCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $product_id;
    public $carts;
    public function render()
    {
        $products = Product::inRandomOrder()->limit(9)->get();

        return view('livewire.admin.userpage.index', [
            'products' =>  $products,

        ])->extends('front.home')->section('products');
        //
    }

    public function show_product($id)
    {

        $prod = Product::find($id);
        return view('livewire.admin.userpage.show-product', compact('prod'));
    }
}
