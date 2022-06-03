@extends('frontend.layouts.master')

@section('content')
    {{-- top news:start --}}
    <div class="grid md:grid-cols-4 col-span-1 gap-5" dir="rtl">
        {{-- main News:start --}}
        @php
            use App\Models\News;
            $topNews = News::where('is_supernews', 1)->where('public', 1)->latest()->first();
            $latestNews = News::latest()->where('public', 1)->first();
        @endphp

        <div class="md:col-span-4 col-span-1 p-3 bg-white rounded">
            @if ($topNews)    
            <div class="w-full grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <div class="w-full rounded overflow-hidden h-72">
                        <img src="{{ Storage::url($topNews->image) }}" alt="" class="w-full">
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="text-right p-5">
                        <h1 class="text-3xl leading-20"><strong>{{ $topNews->title }}</strong></h1>

                        <p class="mt-3 text-gray-500">{{ $topNews->description }}</p>

                        <hr class="my-3">

                        <div class="">
                            <a href="{{ route('home.news', $topNews->slug) }}" class="w-full block px-3 py-2 text-white bg-blue-400 text-center border border-blue-400 duration-150 hover:bg-white hover:text-blue-400">ادامه مطلب</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- main NewsL:end --}}
            @endif
        </div>

        {{-- newses:start --}}
        @foreach (App\Models\News::latest()->where('public', 1)->where('is_supernews', 1)->get() as $news)
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



    {{-- a look to Hazaras:start --}}
    <div class="grid md:grid-cols-4 gap-5 mt-40" dir="rtl">
        <div class="md:col-span-4 col-span-1">
            <div class="my-3 flex justify-start px-10 relative">
                <h2 class="md:text-4xl text-2xl font-bold z-50">دیگر</h2>
                <div class="h-3 w-32 bg-red-200 absolute top-6"></div>
            </div>
        </div>

        @if( $latestNews)
        {{-- news:start --}}
        <div class="md:col-span-3 col-span-1 p-3 bg-white rounded">
            <div class="w-full grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <div class="w-full rounded overflow-hidden h-72">
                        <img src="{{ Storage::url($latestNews->image) }}" alt="" class="w-full">
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="text-right p-5 overflow-hidden">
                        <h1 class="text-3xl leading-20"><strong>{{ $latestNews->title }}</strong></h1>

                        <p class="mt-3 text-gray-500">{{ $latestNews->description }}</p>

                        <hr class="my-3">

                        <div class="">
                            <a href="{{ route('home.news', $latestNews->slug) }}" class="w-full block px-3 py-2 text-white bg-blue-400 text-center border border-blue-400 duration-150 hover:bg-white hover:text-blue-400">ادامه مطلب</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach (App\Models\News::latest()->where('public', 1)->limit(9)->get() as $news)
            <div class="col-span-1">
                <div class="w-full bg-white rounded md:h-[350px] relative overflow-hidden md:block flex flex-row-reverse flex-wrap">
                    <div class="md:w-full w-2/5 h-40 overflow-hidden">
                        <img src="{{ Storage::url($news->image) }}" alt="news image">
                    </div>
                    <div class="md:w-full w-3/5 p-3 text-right font-bold text-xl">
                        <h4>{{ $news->title }}</h4>
                        <p class="mt-3 text-gray-500 text-sm">1 ساعت پیش</p>
                    </div>
                    <div class="md:absolute w-full bottom-5 md:m-0 mt-3 md:px-5">
                        <a href="{{ route('home.news', $news->slug) }}" class="block text-center w-full py-1 border border-blue-300 bg-blue-300 text-white hover:bg-white hover:text-blue-400 duration-150">ادامه مطلب</a>
                    </div>
                </div>
            </div> 
        @endforeach
        {{-- news:start --}}
    </div>
    {{-- a look to Hazaras:end --}}


    {{-- most views:start --}}
    <div class="w-full bg-white p-5 mt-40">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
            <div class="col-span-1">
                <div class="w-full py-3 text-center text-xl text-white bg-blue-300">
                    <h4>پر بیننده ترین ها</h4>
                </div>
                <div class="flex justify-end mt-5 text-right">
                    <ul class="w-full px-5">
                        @foreach (App\Models\News::orderBy('views', 'desc')->limit(5)->get() as $news)    
                            <li class="flex justify-end items-center my-4 hover:text-blue-500">
                                <a href="{{ route('home.news', $news->slug) }}">{{ $news->title }}</a>
                                <div class="w-5 h-5 border-2 transform rotate-[45deg] ml-5">

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-span-1">
                <div class="w-full py-3 text-center text-xl text-white bg-red-400">
                    <h4>تازه ترین خبر ها</h4>
                </div>
                <div class="flex justify-end mt-5 text-right">
                    <ul class="w-full px-5">
                        @foreach (App\Models\News::latest()->where('public', 1)->limit(10)->get() as $news)
                        <li class="flex justify-end items-center my-4 hover:text-blue-500">
                            <a href="{{ route('home.news', $news->slug) }}">{{ $news->title }}</a>
                            <div class="w-5 h-5 border-2 transform rotate-[45deg] ml-5">

                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- most views:end --}}


    {{-- news from categories:start --}}
    @foreach (App\Models\Category::limit(4)->get() as $category)
        @if($category->news()->count() > 0)
            <div class="grid md:grid-cols-4 gap-5 mt-40" dir="rtl">
                <div class="md:col-span-4 col-span-1">
                    <div class="my-3 flex justify-start px-10 relative">
                        <h2 class="md:text-4xl text-2xl font-bold z-50">{{ $category->name }}</h2>
                        <div class="h-3 w-32 bg-red-200 absolute top-6"></div>
                    </div>
                </div>

                @foreach ($category->news()->where('public', 1)->get() as $news)
                    <div class="col-span-1">
                        <div class="w-full bg-white rounded md:h-[350px] relative overflow-hidden md:block flex flex-row-reverse flex-wrap">
                            <div class="md:w-full w-2/5 h-40 overflow-hidden">
                                <img src="{{ Storage::url($news->image) }}" alt="">
                            </div>
                            <div class="md:w-full w-3/5 p-3 text-right font-bold text-xl">
                                <h4>{{ $news->title }}</h4>
                                <p class="mt-3 text-gray-500 text-sm">1 ساعت پیش</p>
                            </div>
                            <div class="md:absolute w-full bottom-5 md:m-0 mt-3 md:px-5">
                                <a href="{{ route('home.news', $news->slug) }}" class="block text-center w-full py-1 border border-blue-300 bg-blue-300 text-white hover:bg-white hover:text-blue-400 duration-150">ادامه مطلب</a>
                            </div>
                        </div>
                    </div> 
                @endforeach
                {{-- news:start --}}
            </div>
        @endif
    @endforeach
    

    {{-- news from categories:ned --}}

@endsection
