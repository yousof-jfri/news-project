@extends('frontend.layouts.master')

@section('content')
    {{-- top news:start --}}
    <div class="grid md:grid-cols-4 col-span-1 gap-5" dir="rtl">
        <div class="md:col-span-4 col-span-1">
            <div class="w-full py-3">
                <h3 class="text-2xl font-bold">آرشیو مقالات</h3>
            </div>
        </div>

        {{-- newses:start --}}
        @foreach ($topics as $topic)
            <div class="col-span-1">
                <div class="w-full bg-white rounded md:h-[350px] relative overflow-hidden md:block flex flex-row-reverse flex-wrap">
                    <div class="md:w-full w-2/5 h-40 overflow-hidden">
                        <img src="{{ Storage::url($topic->image) }}" alt="" class="w-full">
                    </div>
                    <div class="md:w-full w-3/5 p-3 font-bold text-xl">
                        <h4>{{$topic->title}}</h4>
                        <p class="mt-3 text-gray-500 text-sm">1 ساعت پیش</p>
                    </div>
                    <div class="w-full p-3">
                        <div class="flex items-center">
                            <img src="{{ $topic->user->image ? Storage::url($topic->user->image) : asset('assets/images/user/1.png') }}" alt="{{ $topic->user->name }}" width="30px" height="30px" class="mx-2">
                            <span>{{ $topic->user->name }}</span>
                        </div>
                    </div>
                    <div class="md:absolute w-full bottom-5 md:m-0 mt-3 md:px-5">
                        <a href="{{ route('home.topic', $topic->slug) }}" class="block text-center w-full py-1 border border-blue-300 bg-blue-300 text-white hover:bg-white hover:text-blue-400 duration-150">ادامه مطلب</a>
                    </div>
                </div>
            </div>  
        @endforeach
        {{-- newses:end --}}
    </div>
    {{-- top news:end --}}

@endsection
