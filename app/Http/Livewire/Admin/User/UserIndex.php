<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.user.user-index',[
            $users = User::with('country', 'city')->get(),
             'title'=>'Users',
        ])->extends('front.home')->section('products');
    }
}