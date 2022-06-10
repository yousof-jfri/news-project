@extends('frontend.layouts.master')

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection

@section('content')
    <div dir="rtl">
        <div class="w-full grid lg:grid-cols-5 gap-5 md:grid-cols-4 grid-cols-1 gap-5">
            <div class="lg:col-span-4 md:col-span-3 col-span-1">
                <div class="w-full bg-white rounded shadow-md">
                    <div class="w-full overflow-hidden">
                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" width="100%" height="auto">
                    </div>
                    <div class="px-5 pb-5">
                        <div class="my-3">
                            <h1 class="md:text-4xl text-xl font-bold"><strong>{{ $news->title }}</strong></h1>
                            <p class="text-gray-600 mt-4">{{ $news->description }}</p>
                        </div>
                        <hr>
                        <div class="my-3">
                            {{ $news->body }}
                        </div>
                    </div>
                </div>

                <livewire:frontend-comments :news="$news"/>
            </div>
            <div class="col-span-1">
                <div class="w-full bg-white rounded shadow-md p-3">
                    <div class="w-full mb-3 font-bold">
                        <span>جدید ترین اخبار</span>
                    </div>
                    <ul>
                        @foreach (App\Models\News::where('public', 1)->limit(10)->latest()->get() as $newses)
                            <li class="my-2 ">
                                <a href="{{ route('home.news', $newses->slug) }}" class="block hover:bg-gray-100 py-1 rounded w-full flex items-center">
                                    <div class="w-2/6 overflow-hidden">
                                        <img src="{{ Storage::url($newses->image) }}" alt="{{ $newses->title }}" class="rounded" width="100%" height="auto">
                                    </div>
                                    <div class="w-3/6 md:text-sm pr-3">
                                        {{ Str::limit($newses->title, 20, '...') }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full bg-white rounded shadow-md p-3 mt-5">
                    <div class="w-full mb-3 font-bold">
                        <span>اخبار فوری</span>
                    </div>
                    <ul>
                        @foreach (App\Models\News::where('public', 1)->where('is_supernews', 1)->limit(5)->latest()->get() as $newses)
                            <li class="my-2 ">
                                <a href="{{ route('home.news', $newses->slug) }}" class="block hover:bg-gray-100 py-1 rounded w-full flex items-center">
                                    <div class="w-2/6 overflow-hidden">
                                        <img src="{{ Storage::url($newses->image) }}" alt="{{ $newses->title }}" class="rounded" width="100%" height="auto">
                                    </div>
                                    <div class="w-3/6 md:text-sm pr-3">
                                        {{ Str::limit($newses->title, 20, '...') }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection