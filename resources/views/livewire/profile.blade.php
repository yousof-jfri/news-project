<div>
    <div class="w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
        {{-- profile:start --}}
        <div class="col-span-1">
            <div class="p-3 rounded bg-white w-full shadow">
                <div class="w-full flex justify-center h-32">
                    <div class="w-[130px] h-[130px] overflow-hidden rounded-full">
                        <img src="{{ $image ? Storage::url($image) : asset('assets/images/user/1.png') }}" alt="">
                    </div>
                </div>
                <div class="px-3">
                    <div class="mt-1 w-full py-3">
                        <span>نام : </span> 
                        @if(!$editActive)
                        <span>{{ $name }}</span>
                        @else
                        <input type="text" wire:model="name"  class="outline-none border px-1 py-1 w-full">
                        @error('name')
                            <span class="text-red-500 mx-3">{{ $message }}</span>
                        @enderror
                        @endif
                    </div>
                    <div class="mt-1 w-full py-3">
                        <span>ایمیل : </span> 
                        @if(!$editActive)
                        <span>{{ $email }}</span>
                        @else
                        <input type="email" wire:model="email"  class="outline-none border px-1 py-1 w-full">
                        @error('email')
                            <span class="text-red-500 mx-3">{{ $message }}</span>
                        @enderror
                        @endif
                    </div>
                    @if($editActive)
                    <div class="mt-1 w-full py-3">
                        <span>رمز ورود : </span>
                        <input type="text" wire:model="password"  class="outline-none border px-1 py-1 w-full">
                    </div>
                    @error('password')
                        <span class="text-red-500 mx-3">{{ $message }}</span>
                    @enderror
                    @endif
                    <div class="mt-1 w-full py-3">
                        <span>بیو : </span> 
                        @if(!$editActive)
                        <span>{{ $bio }}</span>
                        @else
                        <input type="text" wire:model="bio"  class="outline-none border px-1 py-1 w-full">
                        @error('bio')
                            <span class="text-red-500 mx-3">{{ $message }}</span>
                        @enderror
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        @if(!$editActive)
                        <button class="text-sm text-yellow-500" wire:click="editStart">ویرایش اطلاعات</button>
                        @else
                        <button class="text-sm text-yellow-500" wire:click="updateUser">ویرایش</button>
                        <button class="text-sm text-red-500" wire:click="cancel">لغو</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- profile:end --}}


        {{-- your comments:start --}}
        <div class="col-span-1">
            <div class="p-3 rounded bg-white shadow">
                <div class="w-full mb-3">
                    <span class="font-bold">آخرین نظرات شما</span>
                </div>
                <hr>
                <div class="mt-3">
                    @if(count(auth()->user()->comments) > 0)
                        @foreach (auth()->user()->comments()->limit(4)->latest()->get() as $comment)
                            <div class="w-full p-2 bg-gray-100 rounded mb-2 flex justify-between items-center flex-wrap">
                                <span class="text-sm">{{ $comment->comment }}</span>
                                <span>به</span>
                                <a class="block cursor-pointer hover:text-blue-400" href="{{ route('home.news', $comment->commentable->id) }}">{{ $comment->commentable->title }}</a>
                            </div>
                        @endforeach
                    @else
                        <div class="w-full p-2 bg-yellow-100 text-yellow-600 rounded mb-2 flex justify-between items-center flex-wrap">
                            <p>شما تا کنون هیچ نظری ثبت نکرده اید</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- your comments:end --}}


        {{-- your topics:start --}}
        <div class="col-span-1">
            <div class="p-3 rounded bg-white shadow">
                <div class="w-full mb-3">
                    <span class="font-bold">مقالات شما</span>
                </div>
                <hr>
                <div class="mt-3">
                    @if(count(auth()->user()->topics) > 0)
                        @foreach (auth()->user()->topics as $topic)    
                            <div class="w-full p-2 bg-gray-100 rounded mb-2 flex items-center mt-3">
                                <div class="w-2/5">
                                    <img src="{{ Storage::url($topic->image) }}" alt="" width="100">
                                </div>
                                <div class="w-2/5 text-right">
                                    <span>{{ $topic->title }}</span>
                                </div>
                                <div class="w-1/5">
                                    <a href="{{ route('admin.topics.edit', $topic->id) }}" class="block text-sm px-1 py-1 bg-yellow-400 hover:bg-yellow-500 rounded text-white text-center my-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.topics.create') }}" class="block text-sm px-1 py-1 bg-red-400 hover:bg-red-500 rounded text-white text-center my-1">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <div class="w-full p-2 bg-yellow-100 text-yellow-600 rounded mb-2 flex justify-between items-center flex-wrap">
                            <p>شما تا کنون هیچ مقاله ای ثبت نکرده اید</p>
                        </div>
                    @endif
                </div>
                <a href="{{ route('admin.topics.create') }}" class="block text-center w-full rounded bg-green-500 text-white font-bold px-3 py-2 duration-150 hover:bg-green-600">
                    <p>ایجاد مقاله جدید</p>
                </a>
            </div>
        </div>
        {{-- your topics:end --}}
    </div>
</div>


@if(session()->has('message'))
<script>
    Swal.fire({
        title: "{{ session()->get('message') }}",
        icon: 'success'
    })
</script>
@endif