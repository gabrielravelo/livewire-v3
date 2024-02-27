<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public $count = 0;

    public function decrement()
    {
        $this->count --;
    }

    public function increment($value = 1)
    {
        $this->count += $value;
    }

    public function render()
    {
        return view('livewire.contador');
    }
}
