<div>
    <div class="row">
        <div class="col-12">
            <div class="h4 text-blue">  {{ __("Invite to Event") }}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="gray paragraph-style2">
                {{ __("An email will be sent to mentioned emails as personal invitation to selected event") }}
            </div>
        </div>
    </div>
    @if (session('status'))
        <div class="mb-4 font-medium alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row my-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="w-100">
                        <div class="row mt-3">
                            <div class="col-12 mobile-marg-2">
                                <label for="intro" class="gray mb-1">@lang('Introduction')</label>
                                <textarea id="intro" wire:model.defer="intro" rows="4" class="form-control" placeholder="@lang('Introduction about me')"></textarea>
                                <x-jet-input-error for="intro" class="mt-2" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            @php
                                /**
                                * @var \App\Models\Fairs\Fair[] $fairs
                                **/
                            @endphp
                            <div class="col-12 mobile-marg-2">
                                <label for="select_event" class="gray mb-1">@lang('Select Event')</label>
                                <select id="select_event" wire:model="selected_fair_id" class="form-control input-field">
                                    <option>@lang('Event Name') </option>
                                    @foreach($fairs ?? [] as $fair)
                                        <option value="{{$fair->id}}">
                                            {{$fair->fair_name ?? $fair->school->school_name}}
                                            {{$fair->eventType->name}} on {{Helpers::dayDateTimeFormat($fair->start_date)}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="selected_fair_id" class="mt-2" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 mobile-marg-2">
                                <label for="intro" class="gray mb-1">@lang('Who do you want to invite')</label>
                            </div>
                        </div>
                        @for($i=0 ;$i<count($invitiees);$i++)
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 mobile-marg-2">
                                <input wire:model.lazy="invitiees.{{$i}}.name" class="form-control input-field" placeholder="{{__("Contact name")}}"/>
                                <x-jet-input-error for="invitiees.{{$i}}.name" class="mt-2" />
                            </div>
                            <div class="col-12 col-md-6 mobile-marg-2">
                                <input wire:model.lazy="invitiees.{{$i}}.email" type="email" class="form-control input-field" placeholder="{{__("Contact email")}}"/>
                                <x-jet-input-error for="invitiees.{{$i}}.email" class="mt-2" />
                            </div>
                        </div>
                        @endfor
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="javascript:void(0)" wire:click="addInvitee">@lang('Add invitee')</a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mobile-marg-2">
                                <label for="intro" class="gray mb-1">@lang('OR/AND you can add multiple invitees')</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 mobile-marg-2">
                                <label for="contacts" class="gray mb-1">@lang('name-email;....')</label>
                                <textarea id="contacts" wire:model.defer="contacts" rows="4" class="form-control"
                                          placeholder="Copy and paste in exactly same format: name1-email1; name2-email2; name3-email3;"></textarea>
                                <x-jet-input-error for="contacts" class="mt-2" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" wire:click="sendInvitation"  class="button-dark-blue width-25 button-sm mobile-btn"
                                        wire:loading.attr="disabled">@lang('Send Invitation')
                                </button>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <div wire:loading.block wire:target="sendInvitation"><i class="fas fa-spinner fa-pulse" aria-hidden="true"></i>
                                        @lang('Sending Invitation')...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
