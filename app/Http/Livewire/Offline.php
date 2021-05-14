<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Offline extends Component
{
    public function render()
    {
        return <<<'blade'
            <div wire:offline class="fixed left-1/2 mt-4">
                <div class="relative -left-1/2 text-red-600 bg-yellow-200 font-bold px-4 py-2">
                    You are offline!
                </div>
            </div>
        blade;
    }
}
