<?php

namespace App\Http\Livewire\School;

use App\Helpers\Helpers;
use App\Models\Fairs\Fair;
use App\Models\Fairs\FairInvitedContact;
use App\Models\Notifications\Notification;
use App\Notifications\Fair\InviteContactToFairNotification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SendEventInvitation extends Component
{
    public $fairs;
    public $selected_fair_id;
    public $intro ='';
    public $contacts;
    public $invitiees=[];

    public function mount(){
        $this->fairs = \Auth::user()->selected_school->fairs()->upcoming()->with(['eventType','school'])->get();
        $this->addInvitee();
    }

    public function addInvitee(){
        $this->invitiees[] = ['name'=>'','email'=>''];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        return [
            'selected_fair_id'=>['required'],
            'intro'=>['required'],
            'invitiees'=>['present','array'],
            'invitiees.*'=>['required'],
            'invitiees.*.email'=>['required','email'],
            'contacts'=>['present',Rule::requiredIf(empty($this->invitiees))]
        ];
    }

    protected function validationAttributes()
    {
        return [
            'selected_fair_id' => "Fair Name",
            'invitiees.*.name' => "Contact Name",
            'invitiees.*.email' => "Contact Email",
        ];
    }
    protected function messages()
    {
        return [
            'selected_fair_id.required' => "Please select a :attribute",
        ];
    }
    public function sendInvitation(){
        $this->resetErrorBag();
        $validated = $this->validate();
        $this->extractContactsFromTest();
        $template_payload = $this->getTemplatePayload();

        foreach ($this->invitiees as $invitee){
            $exist = FairInvitedContact::whereEmail($invitee['email'])->whereEventId($this->selected_fair_id)->exists();
            if (empty($invitee['email']) || $exist){
                continue;
            }
            $invitee['event_id']= $this->selected_fair_id;
            $invitee['user_id']= \Auth::id();
            $user = FairInvitedContact::create($invitee);
            $template_payload['invited_contact_name']=$invitee['name'];
            $template_payload['invited_contact_email']=$invitee['email'];
            $template_payload['invited_body']=$invitee['name'];
            $user->notify(new InviteContactToFairNotification($template_payload));
        }
        $this->resetForm();
        session()->flash('status', 'Invitation Sent Successfully!');
    }
    public function resetForm(){
        $this->invitiees = [];
        $this->intro = '';
        $this->selected_fair_id = '';
        $this->contacts = '';
        $this->addInvitee();
    }

    protected function extractContactsFromTest(){
        if(!empty($this->contacts)){
            $invitees = collect(\Str::of($this->contacts)->trim()->explode(';')->toArray());
            $invitees->filter(fn ($item)=>!empty($item))->transform(function($item){
                $contact = \Str::of($item)->trim()->squish()->explode('-')->toArray();
                return ['name'=>trim($contact[0]),'email'=>trim($contact[1])];
            })->each(fn($item)=>$this->invitiees[] = $item);
        }
    }

    protected function getTemplatePayload(): array
    {
        $fair = Fair::whereId($this->selected_fair_id)
            ->with(['eventType','school.country','school.city','school.country','school.g_12_fee_range','school.curriculum'])
            ->first();
        return [
            'Invitation_body'=>$this->intro,
            'event_name'=>($fair->fair_name ?? $fair->school->school_name). $fair->eventType?->name,
            'event_date'=>\Helpers::dayDateTimeFormat($fair->start_date),
            'country'=>$fair->school->country?->country_name ??  'N/A',
            'city'=>$fair->school->city?->city_name??  'N/A',
            'location'=>$fair->school->address1 ??  'N/A',
            'fair_type'=>$fair->fairType?->fair_type_name ?? 'In Campus',
            'grade_11_students'=>$fair->school->number_grade11 ?? 'N/A',
            'grade_12_students'=>$fair->school->number_grade12 ?? 'N/A',
            'grade_12_fee'=>$fair->school->g_12_fee_range?->currency_range ?? 'N/A',
            'school_curriculums'=>$fair->school->curriculum?->title ?? 'N/A',
            'map_location'=>$fair->school->map_link ?? 'N/A',
            'button_url'=>url('/'),
        ];
    }
    public function render()
    {
        return view('livewire.school.send-event-invitation');
    }
}
