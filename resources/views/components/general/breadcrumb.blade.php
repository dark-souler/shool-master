@props(['links'=>explode('.',Route::current()->action['as'])])
<ul class="d-flex gray ps-0" style="list-style: none">
    @foreach($links as $link)
        @php
        $title = Str::of($link)->studly()->snake(' ')->title();
        $group = Str::before(Route::current()->action['as'],$link)."{$link}.show";
        $url = Route::has($group)? route($group) : "javascript:void(0)";
        @endphp
        @if(!$loop->last)
            <li><a href="{{$url}}" class="gray">{{$title}}</a></li>
            <li class="mx-1">/</li>
        @else
            <li><span class="light-blue">{{$title}}</span></li>
        @endif
    @endforeach
</ul>
