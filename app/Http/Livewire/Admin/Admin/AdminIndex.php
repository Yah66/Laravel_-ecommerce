<?php

namespace App\Http\Livewire\Admin\Admin;

use Livewire\Component;

class AdminIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.admin.admin-index')
            ->extends('layouts.index') // Specify the path to the index template
            ->section('content'); // Define the content section to replace in the index template
    }
}