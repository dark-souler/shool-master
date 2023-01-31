<div>
    <div @class(['d-none'=>$tab != 'basic_info'])>
        <livewire:school.info.basic-info/>
    </div>
    <div @class(['d-none'=>$tab != 'location_info'])>
        <livewire:school.info.location-info/>
    </div>
    <div @class(['d-none'=>$tab != 'student_info'])>
        <livewire:school.info.student-info/>
    </div>
    {{--User Profile Information Tabs--}}
    <div @class(['d-none'=>$tab != 'user-personal-info'])>
        <livewire:user.tabs.user-personal-info-tab-content/>
    </div>
    <div @class(['d-none'=>$tab != 'user-phone-number'])>
        <livewire:user.tabs.user-phone-number-tab-content/>
    </div>
    <div @class(['d-none'=>$tab != 'user-password'])>
        <livewire:user.tabs.user-update-password-tab-content/>
    </div>
</div>
