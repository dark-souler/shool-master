<?php

namespace App\Http\Livewire\Pages\Points;

use Livewire\Component;

class ConvertSmCredit extends Component
{
    /**
     * @var float $credit_total ;
     **/
    public $credit_total;
    public function mount()
    {
        $this->credit_total = calculateSchoolTotalSM();
    }

    public function render()
    {
        return view('livewire.pages.points.convert-sm-credit');
    }
}
