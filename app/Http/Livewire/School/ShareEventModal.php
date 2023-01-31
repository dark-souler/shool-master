<?php

namespace App\Http\Livewire\School;

use App\Models\Fairs\Fair;
use App\Models\Suggestions\SuggestedContact;
use Livewire\Component;

class ShareEventModal extends Component
{
    public $fairs;
    public $selected_fair_id;

    public $openShareEventModal = false;

    protected $listeners = ['showShareEventModal','onModelClose'];

    public function showShareEventModal(){
        $this->fairs = \Auth::user()->selected_school->fairs()->upcoming()->with(['eventType','school'])->get();
        $this->openShareEventModal = true;
    }

    public function closeShareEventModal(){
        $this->openShareEventModal = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function onModelClose(){
        $this->fairs = [];
        $this->selected_fair_id = '';
        $this->closeShareEventModal();
    }

    protected function rules(){
        return [
            'selected_fair_id'=>['required'],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'selected_fair_id' => "Fair Name",
        ];
    }
    protected function messages()
    {
        return [
            'selected_fair_id.required' => "Please select a :attribute",
        ];
    }
    public function sendInvitation(){
        $validated = $this->validate();
        $validated['user_id'] = \Auth::id();
        dd($validated);
        $this->closeShareEventModal();
    }

    public function render()
    {
        return view('livewire.school.share-event-modal');
    }
}
