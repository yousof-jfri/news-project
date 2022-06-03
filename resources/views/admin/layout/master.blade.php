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

    {{-- sweetalert --}}
    <link rel="stylesheet" href="{{ asset('assets/css/Core/sweetAlert2/sweetalert2.min.css') }}">

    {{-- live wire --}}
    @livewireStyles

    @yield('css')
</head>

<body class="bg-gray-100 text-gray-800" dir="rtl">

    <div class="w-full flex justify-between">
        <div class="lg:block hidden w-[20vw]"></div>
        <div class="overflow-y-auto fixed right-0 lg:w-[20vw] w-[250px] p-5 bg-white border-l shadow h-[100vh] lg:block hidden z-50" id="mainMenu">
            {{-- profile image:start --}}
            <div class="p-3">
                <div class="flex justify-center items-center flex-wrap">
                    <div class="md:w-32 md:h-32 h-24 w-24 bg-gray-100 rounded-full overflow-hidden cursor-pointer group relative">
                        <img src="{{ auth()->user()->image ? Storage::url(auth()->user()->image) : asset('assets/images/user/1.png') }}" alt="profile image" class="w-full">
                        <div class="absolute bottom-0 left-0 w-full p-0 h-0 group-hover:h-10 group-hover:p-1 duration-500 bg-gray-600 text-center text-white">
                            <i class="fa fa-image"></i>
                        </div>
                    </div>
                    <div class="w-full text-center text-gray-600 mt-3">
                        <p class="font-bold text-xl">{{ auth()->user()->name }}</p>
                        <p class="text-semibold">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
            {{-- profile image:end --}}

            @include('admin.layout.mainMenu')
        </div>

        <div class="lg:w-[79vw] w-full p-5 box-border">
            {{-- haeader:start --}}
            <div class="w-full bg-white px-5 py-2 rounded-xl shadow box-border flex justify-between">

                <div class="">
                    <ul class="flex">
                        @guest   
                            <li class="mx-1">
                                <a href="{{ route('login') }}" class="block px-3 duration-150 text-white hover:bg-white hover:text-blue-400 border border-blue-400 py-2 bg-blue-400 text-white rounded">ورود | ثبت نام</a>
                            </li>
                        @else
                            <li class="mx-1 relative">
                                <div class="flex items-center cursor-pointer" onclick="toggleElem('#user-menu')">
                                    <i class="fa fa-angle-down"></i>
                                    <span class="mx-3">{{ auth()->user()->name }}</span>
                                    <div class="w-[30px] h-[30px] rounded-full bg-gray-200 overflow-hidden ">
                                        <img src="{{ auth()->user()->image ? Storage::url(auth()->user()->image) : asset('assets/images/user/1.png')  }}" alt="">
                                    </div>
                                </div>
                                <div id="user-menu" class="hidden absolute top-10 right-5 w-[150px] bg-white rounded overflow-hidden shadow-md border z-50">
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

               <div>
                    <button class="h-8 w-8 border rounded relative lg:hidden block" id="toggleButton">
                        <div class="absolute left-[5px] top-[10px] w-[20px] h-[3px] rounded-t-full bg-gray-500"></div>
                        <div class="absolute left-[5px] top-[17px] w-[20px] h-[3px] rounded-b-full bg-gray-500"></div>
                    </button>
               </div>
                
            </div>
            {{-- haeader:start --}}

            <div class="mt-5">
                @yield('content')
            </div>
        </div>
    </div>


    {{-- sweetAlert2 --}}
    <script src="{{ asset('assets/js/Core/sweetAlert2/sweetalert2.all.min.js') }}"></script>
    
    @yield('js')
    
    {{-- live wire --}}
    @livewireScripts    

    {{-- custome js --}}
    <script src="{{ asset('assets/js/Scripts/admin.js') }}"></script>

</body>
</html>