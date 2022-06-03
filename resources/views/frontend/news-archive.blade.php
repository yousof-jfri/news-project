@extends('frontend.layouts.master')

@section('content')
    {{-- top news:start --}}
    <div class="grid md:grid-cols-4 col-span-1 gap-5" dir="rtl">

        {{-- newses:start --}}
        @foreach ($newses as $news)
            <div class="col-span-1">
                <div class="w-full bg-white rounded md:h-[350px] relative overflow-hidden md:block flex flex-row-reverse flex-wrap">
                    <div class="md:w-full w-2/5 h-40 overflow-hidden">
                        <img src="{{ Storage::url($news->image) }}" alt="" class="w-full">
                    </div>
                    <div class="md:w-full w-3/5 p-3 text-right font-bold text-xl">
                        <h4>{{$news->title}}</h4>
                        <p class="mt-3 text-gray-500 text-sm">1 ساعت پیش</p>
                    </div>
                    <div class="md:absolute w-full bottom-5 md:m-0 mt-3 md:px-5">
                        <a href="{{ route('home.news', $news->slug) }}" class="block text-center w-full py-1 border border-blue-300 bg-blue-300 text-white hover:bg-white hover:text-blue-400 duration-150">ادامه مطلب</a>
                    </div>
                </div>
            </div>  
        @endforeach
        {{-- newses:end --}}
    </div>
    {{-- top news:end --}}

@endsection
