<?php

namespace App\Http\Livewire\Sponsored;

use App\Models\General\Countries;
use App\Models\School\SchoolSponsoredEvent;
use App\Models\School\SchoolSponsoredEventOffer;
use App\Models\School\SchoolSponsoredEventType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class SponsoredEvents extends Component
{
    use WithPagination;

    public $openCreateModel=false;
    public $openOffersModel=false;
    public $offers = [];
    protected $listeners = ['onModelClose'];
    public SchoolSponsoredEvent|null $selected_event;
    public $form = [];
    public $countries=[];
    public $event_types=[];

    public function mount(){
        $this->setFormData();
        $this->event_types = SchoolSponsoredEventType::get();
        $this->countries = Countries::orderBy('country_name')->get();
        $this->selected_event = null;
    }
    public function onModelClose(){
        $this->openOffersModel=false;
        $this->openCreateModel= false;
        $this->setFormData();
        $this->selected_event = null;
        $this->resetErrorBag();
    }

    public function createEvent(){
        $this->setFormData();
        $this->openCreateModel = true;
    }

    public function edit(SchoolSponsoredEvent $event){
        $this->selected_event = $event;
        $this->setFormData($event);
        $this->openCreateModel = true;
    }

    protected function rules(){
        return [
            'form'=>['required','array'],
            'form.*'=>['required'],
            'form.amount'=>['required','numeric']
        ];
    }

    protected function validationAttributes(){
        return [
            'form.name'=>'Event Name',
            'form.sponsored_event_type_id'=>'Event Type',
            'form.target_country_id'=>'Target Location',
            'form.allow_multiple_sponsors'=>'Multiple Sponsors Status',
            'form.event_datetime'=>'Event Datetime',
            'form.deadline'=>'Event Deadline',
            'form.amount'=>'Amount',
            'form.description'=>'Descriptions'
        ];
    }

    public function saveEvent(){
        $inputs = $this->validate()['form'];
        if (!empty($this->selected_event)){
            $this->selected_event->update($inputs);
            session()->flash('status', 'Event Updated!');
        }else{
            \Auth::user()->selected_school->sponsoredEvents()->create($inputs);
            session()->flash('status', 'Event Request Created!');
        }
        $this->openCreateModel = false;
    }
    public function setFormData(SchoolSponsoredEvent $event = null){
        $this->form['name'] = $event?->name ?? '';
        $this->form['sponsored_event_type_id'] = $event?->sponsored_event_type_id ?? '';
        $this->form['event_datetime'] = $event?->event_datetime ?? '';
        $this->form['deadline'] = $event?->deadline ?? '';
        $this->form['amount'] = $event?->amount ?? '';
        $this->form['description'] = $event?->description ?? '';
        $this->form['target_country_id'] = $event?->target_country_id ?? '';
        $this->form['allow_multiple_sponsors'] = $event?->allow_multiple_sponsors ?? false;
    }

    public function render()
    {
        $events  = $this->loadEvents();
        return view('livewire.sponsored.sponsored-events',compact('events'));
    }

    public function loadEvents(): LengthAwarePaginator
    {
        return \Auth::user()->selected_school->sponsoredEvents()
            ->withCount('offers')
            ->withMax('offers as top_offer','amount')
            ->paginate(10);
    }
    public function viewOffers(SchoolSponsoredEvent $event){
        $event->load('offers.university.country');
        $this->selected_event = $event;
        $this->openOffersModel = true;
    }

    public function acceptOffer(SchoolSponsoredEventOffer $offer){
        $this->updateOfferStatus($offer,\AppConst::APPROVED);
    }

    public function rejectOffer(SchoolSponsoredEventOffer $offer){
        $this->updateOfferStatus($offer,\AppConst::REJECTED);
    }
    public function resetOffer(SchoolSponsoredEventOffer $offer){
        $this->updateOfferStatus($offer,\AppConst::PENDING);
    }

    private function updateOfferStatus(SchoolSponsoredEventOffer $offer,$status){
        $offer->update(['status'=>$status]);
        $this->selected_event->refresh();
    }


}
