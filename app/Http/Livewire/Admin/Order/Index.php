<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public function render()
    {
        $query = Order::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $data = $query->get();
        // dd($data);
        return view('livewire.admin.order.index', [
            'data' => $data,
            // 'categories' => $this->categories
        ])
            ->extends('admin.dashbord')
            ->section('content');
    }
}