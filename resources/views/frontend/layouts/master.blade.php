<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- tailwind -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- font --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    @yield('css')
</head>

<body class="bg-gray-100 text-gray-800">

    <header>
        <div class="w-full p-5 bg-white border-b">
            <div class="md:px-20 px-5">
                <div class="flex justify-between items-center">
                    {{-- toggle button --}}
                    <button class="h-8 w-8 border rounded relative md:hidden block" id="toggleButton">
                        <div class="absolute left-[5px] top-[10px] w-[20px] h-[3px] rounded-t-full bg-gray-500"></div>
                        <div class="absolute left-[5px] top-[17px] w-[20px] h-[3px] rounded-b-full bg-gray-500"></div>
                    </button>


                     {{-- auth  --}}
                    <div class="">
                        <ul class="flex">
                            @guest   
                                <li class="mx-1">
                                    <a href="{{ route('login') }}" class="block px-3 duration-150 text-white hover:bg-white hover:text-blue-400 border border-blue-400 py-2 bg-blue-400 text-white rounded">ورود | ثبت نام</a>
                                </li>
                            @else
                                <li class="mx-1 relative">
                                    <div class="flex items-center cursor-pointer" id="openUser">
                                        <i class="fa fa-angle-down"></i>
                                        <span class="mx-3">{{ auth()->user()->name }}</span>
                                        <div class="w-[30px] h-[30px] rounded-full bg-gray-200 overflow-hidden ">
                                            <img src="{{ auth()->user()->image ? Storage::url(auth()->user()->image) : asset('assets/images/profile/1.png')  }}" alt="">
                                        </div>
                                    </div>
                                    <div id="userMenu" class="hidden absolute top-10 left-0 w-[150px] bg-white rounded overflow-hidden shadow-md border z-50">
                                        <div class="w-full">
                                            <a href="{{ route('admin.profile') }}" class="flex justify-between w-full items-center py-2 px-3 hover:bg-gray-100 duration-150">
                                                <i class="fa fa-user text-sm"></i>
                                                <span>پروفایل</span>
                                            </a>
                                        </div>
                                        <div class="w-full">
                                            <form action="{{ route('logout') }}" method="post" id="logout">
                                                @csrf
                                                <button type="submit" class="flex justify-between w-full items-center py-2 px-3 hover:bg-gray-100 duration-150">
                                                    <i class="fa fa-sign-out-alt text-sm"></i>
                                                    <span>خروج</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div> 


                    {{-- search:start --}}
                    <div class="p-1 border px-3 md:block hidden rounded-xl">
                        <form action="" method="get">
                            <button type="submit" class="px-2">
                                <i class="fa fa-search"></i>
                            </button>
                            <input type="text" name="search" class="p-1 outline-none text-right" placeholder="دنبال چی میگردی؟">
                        </form>
                    </div>
                    {{-- search:end --}}

                    {{-- logo:start --}}
                    <div class="text-2xl">
                        <a href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    {{-- logo:end --}}
                </div>
            </div>
        </div>

        <nav id="main-menu" class="md:flex hidden md:h-auto h-[100vh] overflow-y-auto md:relative fixed md:w-full w-4/5 md:z-30 z-50 top-0 right-0 justify-between items-center bg-white border-b shadow-sm">
            <div class="p-5 flex justify-between border-b md:hidden">
                <button class="flex justify-center rounded items-center border w-8 h-8">
                    <i class="fa fa-user"></i>
                </button>
                <a href="{{ url('/') }}" class="text-xl">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="p-3 md:hidden block">
                <div class="my-2 text-right">
                    <h3 class="text-xl">جستجو</h3>
                </div>
                <div class="p-1 border px-3">
                    <form action="">
                        <button type="submit" class="px-2"><i class="fa fa-search"></i></button>
                        <input type="text" class="p-1 outline-none text-right" placeholder="دنبال چی میگردی؟">
                    </form>
                </div>
            </div>
            <div class="md:px-20 md:flex justify-end w-full">
                <div class="my-2 text-right md:hidden block">
                    <h3 class="text-xl">بخش های سایت</h3>
                </div>
                <ul class="md:flex md:flex-row-reverse items-center text-right">
                    <li>
                        <a href="{{ route('home') }}" class="block py-3 px-5 border-b-4 duration-150 border-white hover:border-blue-600 {{ is_url('home', 'border-blue-600') }}">صفحه اصلی</a>
                    </li>
                    @foreach (App\Models\Category::where('parent_id', 0)->get() as $category)
                        <li>
                            <a href="{{ route('home.cate.news', $category->slug) }}" class="block py-3 px-5 border-b-4 duration-150 border-white hover:border-blue-600 ">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('home.archive') }}" class="block py-3 px-5 border-b-4 duration-150 border-white hover:border-blue-600 {{ is_url('home.archive', 'border-blue-600') }}">آرشیو مقالات</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="mt-5 px-10">
        @yield('content')
    </main>


    <footer class="w-full mt-40">
        <div class="w-full py-3 px-5 flex justify-between items-center">
            <div class="flex justify-between">
                <ul class="flex justify-between items-center">
                    <li class="mx-1">
                        <a href="" class="block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="" class="block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="" class="block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="" class="block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <a href="" class="text-xl font-bold">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </div>
        <div class="w-full grid md:grid-cols-4 col-span-1 gap-5 p-5 bg-white rounded-t-xl">
            <div class="col-span-1 text-right md:mt-0 mt-5">
                <div class="w-full py-3 relative">
                    <h6 class="text-xl font-bold z-50">صفحات سایت</h6>
                    <div class="w-32 h-4 bg-blue-500 absolute top-6 right-0 z-10 opacity-[0.4]"></div>
                </div>
                <ul class="px-5">
                    <li class="text-right mt-3 hover:text-blue-400 transform hover:translate-y-[-2px] duration-150">
                        <a href="{{ route('home') }}">صفحه اصلی</a>
                    </li>
                    @foreach (App\Models\Category::where('parent_id', 0)->get() as $category)
                        <li class="text-right mt-3 hover:text-blue-400 transform hover:translate-y-[-2px] duration-150">
                            <a href="{{ route('home.cate.news', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    <li class="text-right mt-3 hover:text-blue-400 transform hover:translate-y-[-2px] duration-150">
                        <a href="{{ route('home.archive') }}">ارشیو مقالات</a>
                    </li>
                </ul>
            </div>

            <div class="col-span-1 text-right md:mt-0 mt-5">
                <div class="w-full py-3 relative">
                    <h6 class="text-xl font-bold z-50">مارا دنبال کنید در</h6>
                    <div class="w-32 h-4 bg-blue-500 absolute top-6 right-0 z-10 opacity-[0.4]"></div>
                </div>

                <ul class="px-5">
                    <li class="mx-1 flex justify-end items-center mt-2">
                        <span class="mr-3 text-gray-500 font-bold">@titan-2018-yj</span>
                        <a href="" class="border block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="mx-1 flex justify-end items-center mt-2">
                        <span class="mr-3 text-gray-500 font-bold">@titan-2018-yj</span>
                        <a href="" class="border block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="mx-1 flex justify-end items-center mt-2">
                        <span class="mr-3 text-gray-500 font-bold">@titan-2018-yj</span>
                        <a href="" class="border block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="mx-1 flex justify-end items-center mt-2">
                        <span class="mr-3 text-gray-500 font-bold">@titan-2018-yj</span>
                        <a href="" class="border block p-0 h-8 w-8 text-blue-400 hover:text-white flex items-center justify-center bg-white shadow-md rounded transform hover:rotate-[360deg] hover:bg-blue-400 duration-500">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="md:col-span-2 col-span-1 text-right md:mt-0 mt-5">
                <div class="w-full py-3 relative">
                    <h6 class="text-xl font-bold z-50">درباره ما</h6>
                    <div class="w-32 h-4 bg-blue-500 absolute top-6 right-0 z-10 opacity-[0.4]"></div>
                </div>
                <p class="text-md text-gray-600 leading-10">ه است. مقامات دولتی اوکراین، روسیه را مسئول این حمله معرفی کرده‌اند اما وزارت دفاع روسیه آن را تکذیب کرده است.ه است. مقامات دولتی اوکراین، روسیه را مسئول این حمله معرفی کرده‌اند اما وزارت دفاع روسیه آن را تکذیب کرده است.</p>
            </div>
        </div>
    </footer>

    {{-- jquery --}}
    <script src="{{ asset('assets/js/Core/JQuery/jquery.min.js') }}"></script>

    {{-- custome js --}}
    <script src="{{ asset('assets/js/Scripts/main.js') }}"></script>

    @yield('js')
</body>
</html>
