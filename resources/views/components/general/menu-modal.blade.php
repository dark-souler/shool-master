@props([
   'routes'=>[
            ['name'=>'basic_info','title'=>'School Basic Info'],
            ['name'=>'location_info','title'=>'School Location'],
            ['name'=>'student_info','title'=>'School Students Info'],
        ],
   'profileroutes'=>[
            ['name'=>'user-personal-info','title'=>'Basic Info'],
            ['name'=>'user-emails','title'=>'Email Addresses'],
            ['name'=>'user-phone-number','title'=>'Phone Numbers'],
            ['name'=>'user-password','title'=>'Change password'],
           ]
])
<div class="modal" id="menu-popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header position-absolute w-100" style="z-index: 10000;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex">
                <div class="auth-card-sidebar d-none d-md-block">
                    <div class="auth-card-overlay p-4">
                        <div class="d-flex">
                            <x-jet-authentication-card-logo/>
                        </div>
                        <div class="mt-5">
                            <div>
                                <h3 class="ms-3 ">{{__('School Menu')}}</h3>
                                <ul style="list-style: none">
                                    <li><a href="{{route('admin.dashboard')}}" class="text-light text-decoration-none">{{ __('Dashboard') }}</a></li>
                                    <li><a href="{{route('admin.university.list')}}" class="text-light text-decoration-none">{{ __('Universities') }}</a></li>
                                    <li><a href="{{route('admin.school.students.list')}}" class="text-light text-decoration-none">{{ __('Students') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-card-main flex-fill p-5">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="h5 blue">@lang('Profile Menu')</h5>
                            <h6 class="h6 gray">@lang('Manage your profile')</h6>
                            <hr>
                            <ul class="sidebar-ul">
                                @foreach ($profileroutes as $count => $route)
                                    <li >
                                        <a class="a-underline blue" href="{{route('admin.school.information')}}?t={{$route['name']}}">
                                            {{ __($route['title']) }}
                                        </a>
                                    </li>
                                @endforeach
                                <li class=""><a
                                        @class(['a-underline blue','light-blue' => Route::is('admin.sessions')])
                                        href="{{route('admin.sessions')}}">@lang("Where you're signed in")</a></li>
                            </ul>
                            <h5 class="h5 blue mt-3">@lang('My Students')</h5>
                            <h6 class="h6 gray">@lang('Manage students registration')</h6>
                            <hr>
                            <ul class="sidebar-ul">
                                <li class="mb-2"><a @class(['a-underline blue','light-blue' => Route::is('admin.school.students.list')])
                                                    href="{{route('admin.school.students.list')}}">@lang('My Students')</a></li>
                                <li class="mb-2"><a @class(['a-underline blue','light-blue' => Route::is('admin.school.students.add')])
                                                    href="{{route('admin.school.students.add')}}">@lang('Add New Student')</a></li>
                                <li class="mb-2"><a
                                        @class(['a-underline blue','light-blue' => Route::is('admin.school.students.addBulk')])
                                        href="{{route('admin.school.students.addBulk')}}">@lang('Add Bulk Students')</a></li>
                                <li class="mb-2"><a
                                        @class(['a-underline blue','light-blue' => Route::is('admin.school.students.registartion.link')])
                                        href="{{route('admin.school.students.registartion.link')}}">@lang('Registration Link')</a></li>
                                <li><a @class(['a-underline blue','light-blue' => Route::is('admin.school.students.registartion.qr')])
                                       href="{{route('admin.school.students.registartion.qr')}}">@lang('Registration QR Code')</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <h5 class="h5 blue ">@lang('School Menu')</h5>
                            <h6 class="h6 gray">@lang('Manage school detail')</h6>
                            <hr>
                            <ul class="sidebar-ul">
                                @foreach ($routes as $count => $route)
                                    <li>
                                        <a class="a-underline blue" href="{{route('admin.school.information')}}?t={{$route['name']}}">
                                            {{ __($route['title']) }}
                                        </a>
                                    </li>
                                @endforeach
                                <li class="">
                                    <a @class(['a-underline blue','light-blue disabled'=>Route::is('admin.school.newBranch')])
                                       href="{{route('admin.school.newBranch')}}"> @lang('School New Branch')
                                    </a>
                                </li>
                            </ul>
                            <h5 class="h5 blue mt-3">@lang('School SM Credit')</h5>
                            <h6 class="h6 gray">@lang('Earned SM credit details')</h6>
                            <hr>
                            <ul class="sidebar-ul">
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.creditDetail')])
                                                href="{{route('admin.school.schoolPoints.creditDetail')}}">@lang('SM credit overview')</a></li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.schoolActivity')])
                                                href="{{route('admin.school.schoolPoints.schoolActivity')}}">@lang('From school activity')</a></li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.universityActivity')])
                                                href="{{route('admin.school.schoolPoints.universityActivity')}}">@lang('From university activity')</a></li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.studentActivity')])
                                                href="{{route('admin.school.schoolPoints.studentActivity')}}">@lang('From student activity')</a></li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.convertCredit')])
                                                href="{{route('admin.school.schoolPoints.convertCredit')}}">@lang('Convert SM credit')</a></li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.school.schoolPoints.creditHistory')])
                                                href="{{route('admin.school.schoolPoints.creditHistory')}}">@lang('SM credit History')</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <h5 class="h5 blue">@lang('Notifications')</h5>
                            <h6 class="h6 gray">@lang('Stay in touch, Stay connected')</h6>
                            <hr>
                            <ul class="sidebar-ul">
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.studentInquiries')])
                                                href="javascript:void(0)">@lang('Students inquiries')</a>
                                    <span class="badge rounded-pill secondary-text align-right float-end">14</span>
                                </li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.messages')])
                                                href="{{route('admin.notification.messages')}}">@lang('Messages')</a>
                                    <span class="badge rounded-pill secondary-text  align-right float-end">14</span>
                                </li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.newEvents')])
                                                href="{{route('admin.notification.messages')}}">@lang('New Events')</a>
                                    <span class="badge rounded-pill secondary-text align-right float-end">15</span>
                                </li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.studentChat')])
                                                href="{{route('admin.notification.studentChat')}}">@lang('Students Chats')</a>
                                    <span class="badge rounded-pill  secondary-text float-end">7</span>
                                </li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.application')])
                                                href="{{route('admin.notification.application')}}">@lang('Application')</a>
                                    <span class="badge rounded-pill secondary-text float-end">5</span>
                                </li>
                                <li class=""><a @class(['a-underline blue','light-blue' => Route::is('admin.notification.schedule')])
                                                href="{{route('admin.notification.schedule')}}">@lang('My Schedule')</a>
                                    <span class="badge rounded-pill secondary-text align-right float-end">5</span>
                                </li>
                                <li><a @class(['a-underline blue','light-blue' => Route::is('admin.calander')])
                                       href="{{route('admin.calander')}}">@lang('My Calendar')
                                    </a>
                                    <span class="badge rounded-pill secondary-text align-right float-end">5</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
