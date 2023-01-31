<?php

namespace App\Http\Livewire\Pages\Components;

use Livewire\Component;

class TotalSmCredit extends Component
{
    public $total_credit = 0;

    public function mount()
    {
        $this->total_credit = calculateSchoolTotalSM();

    }

    public function render()
    {
        return view('livewire.pages.components.total-sm-credit');
    }
}
