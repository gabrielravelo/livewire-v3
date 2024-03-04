<?php

namespace App\Livewire;

use Livewire\Component;

class Children extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.children');
    }
}
