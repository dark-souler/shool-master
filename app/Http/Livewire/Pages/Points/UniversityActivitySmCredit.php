<?php

namespace App\Http\Livewire\Pages\Points;

use App\Models\School\SchoolPointHistory;
use Livewire\Component;

class UniversityActivitySmCredit extends Component
{
    /**
     * @var \App\Models\School\SchoolPointHistory $histories;
     * @var float $credit_total;
     * @var float $university_total;
     * @var float $points_out_total;
     * @var float $points_in_total;
     **/

    public $histories;
    public $credit_total;

    public function mount()
    {
        $school = \Auth::user()->selected_school;
        $this->credit_total = calculateSchoolTotalSM();
        $this->histories = $school->pointsHistory()
            ->whereRelation('pointType', 'source_id', \AppConst::SM_POINT_TYPE_UNIVERSITY_EVENTS)
            ->groupBy('school_point_type_id')
            ->selectRaw("count(*) as transaction_count, school_point_type_id, sum(points_in) as transaction_sum")
            ->with('pointType')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.points.university-activity-sm-credit');
    }
}
