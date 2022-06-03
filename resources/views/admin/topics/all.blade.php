@extends('admin.layout.master')

@section('content')
    {{-- breadCrumbs:start --}}
    <div class="w-full my-5">
        <ul class="flex items-center">
            <li class="mx-2">
                <a href="{{ route('home') }}">خانه</a>
            </li>
            <li class="mx-2">
                <span>
                    <i class="fa fa-angle-left"></i>
                </span>
            </li>
            @if(auth()->user()->is_superuser == 1 || auth()->user()->is_staff == 1)
            <li class="mx-2">
                <a href="{{ route('admin') }}">پنل مدیریتی</a>
            </li>
            <li class="mx-2">
                <span>
                    <i class="fa fa-angle-left"></i>
                </span>
            </li>
            @endif
            <li class="mx-2">
                <a href="#" class="text-blue-500">مقالات</a>
            </li>
        </ul>
    </div>
    {{-- breadCrumbs:end --}}

    <livewire:topics/>
@endsection