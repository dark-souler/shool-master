<?php

namespace App\Http\Livewire\Pages\Points;

use App\Models\School\SchoolPointHistory;
use Livewire\Component;

class SchoolSmCreditDetail extends Component
{
    /**
     * @var float $school_activity_credit;
     * @var float $university_activity_credit;
     * @var float $students_activity_credit ;
     * @var float $credit_total;
     **/

    public $credit_total;
    public $school_activity_credit;
    public $university_activity_credit;
    public $students_activity_credit;
    public function mount()
    {
        $school = \Auth::user()->selected_school;
        $this->credit_total = calculateSchoolTotalSM();

        $this->school_activity_credit = $school->pointsHistory()
            ->whereRelation('pointType', 'source_id', \AppConst::SM_POINT_TYPE_SCHOOL_EVENTS)
            ->sum('points_in');

        $this->university_activity_credit = $school->pointsHistory()
                ->whereRelation('pointType', 'source_id', \AppConst::SM_POINT_TYPE_UNIVERSITY_EVENTS)
                ->sum('points_in');

        $this->students_activity_credit = $school->pointsHistory()
            ->whereRelation('pointType', 'source_id', \AppConst::SM_POINT_TYPE_STUDENT_ACTIVITY)
            ->sum('points_in');

    }

    public function render()
    {
        return view('livewire.pages.points.school-sm-credit-detail');
    }
}
