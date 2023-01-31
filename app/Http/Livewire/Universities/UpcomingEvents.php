<?php

namespace App\Http\Livewire\Universities;

use App\Models\General\Countries;
use App\Models\University\UniversityEventInvitation;
use App\Models\University\UniversityEventType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;

class UpcomingEvents extends Component
{
    public $countries = [];
    public $country = '';
    public $type;
    public $type_title;
    public $period='';
    protected $queryString = ['country'=>['except'=>''],'period'=>['except'=>'']];
    public function mount(){
        $this->loadCountries();
        $this->type_title = UniversityEventType::find($this->type)?->title;
    }
    public function render()
    {
        $events = $this->loadEvents();
        return view('livewire.universities.upcoming-events',compact('events'));
    }
    public function loadEvents(): LengthAwarePaginator
    {
        $school = \Auth::user()->selected_school;
        $period = explode(' to ',$this->period);
        return $school->universityEvents()->where('university_event_type_id',$this->type)
            ->when(!empty($this->country),fn($q)=>$q->where('country_id',$this->country))
            ->when(count($period) > 1,fn($q)=>$q->whereBetween('start_datetime',$period))
            ->paginate(50);
    }

    public function register(UniversityEventInvitation $invitation){
        $invitation->update(['accepted_by_school'=>\AppConst::INVITATION_ACCEPTED]);
    }
    public function revoke(UniversityEventInvitation $invitation){
        $invitation->update(['accepted_by_school'=>\AppConst::INVITATION_PENDING]);
    }

    private function loadCountries(){
        $school = \Auth::user()->selected_school;
        $subQ = $school->universityEvents()->select('country_id')->where('university_event_type_id',$this->type);
        $this->countries = Countries::orderBy('country_name')->whereIn('id',$subQ)->get();
    }
}
