<div>
    {{-- Suggest Shere Event Modal --}}
    <x-jet-modal wire:model="openShareEventModal">
        <x-slot name="title">
            {{ __("Share Event") }}
        </x-slot>
        <x-slot name="description">
            <div class="row">
                <div class="col-12">
                    <div class="gray paragraph-style2">
                        {{ __("Share event with your students, student's parents and social Media") }}
                    </div>
                </div>
            </div>
        </x-slot>
        <div class="row mt-3">
            @php
            /**
            * @var \App\Models\Fairs\Fair[] $fairs
            **/
            @endphp
            <div class="col-12 mobile-marg-2">
                <select wire:model="selected_fair_id" class="form-control input-field">
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
           <div class="col">
                <button type="submit" wire:click="sendInvitation"  class="button-light-blue button-sm w-100 mobile-btn"
                        wire:loading.attr="disabled"><i class="fa-solid fa-share-nodes"></i> @lang('Share')
                </button>
           </div>
            <div class="col">
                <button type="submit" wire:click="sendInvitation"  class="button-light-blue button-sm w-100 mobile-btn"
                        wire:loading.attr="disabled"> <i class="fa-brands fa-facebook"></i> @lang('Share')
                </button>
            </div>
            <div class="col">
                <button type="submit" wire:click="sendInvitation"  class="button-light-blue button-sm w-100 mobile-btn"
                        wire:loading.attr="disabled"> <i class="fa-brands fa-twitter"></i> @lang('Share')
                </button>
            </div>
            <div class="col">
                <button type="submit" wire:click="sendInvitation"  class="button-light-blue button-sm w-100 mobile-btn"
                        wire:loading.attr="disabled"><i class="fa-brands fa-linkedin-in"></i> @lang('Share')
                </button>
            </div>
            <div class="col">
                <button type="submit" wire:click="sendInvitation"  class="button-light-blue button-sm w-100 mobile-btn"
                        wire:loading.attr="disabled"><i class="fa-brands fa-whatsapp"></i> @lang('Share')
                </button>
            </div>
        </div>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <div wire:loading.block wire:target="sendInvitation"><i class="fas fa-spinner fa-pulse" aria-hidden="true"></i>
                        @lang('Sending Invitation')...
                    </div>
                </div>
            </div>

    </x-jet-modal>
</div>
