<div>

    <div id="newUserForm" class="w-full bg-white rounded-xl border overflow-hidden mb-5 @if(!$createOpen) hidden @endif">
        {{-- card:header --}}
        <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
            @if($editActive)
            <h3 class="text-xl font-bold">ویرایش کاربر</h3>
            @else
            <h3 class="text-xl font-bold">کاربر جدید</h3>
            @endif
        </div>

        {{-- card body --}}
        <div class="w-full py-3 px-5 overflow-x-auto">
            <div class="my-3">
                <label for="name">نام</label>
                <input type="text" wire:model.debounce.500ms="name" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="نام خود را وارد کنید">
                @error('name')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="name">ایمیل</label>
                <input type="email" wire:model.debounce.500ms="email" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="ایمیل خود را وارد کنید">
                @error('email')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="name">رمز ورود</label>
                <input type="password" wire:model.debounce.500ms="password" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="رمز ورود خود را وارد کنید">
                @error('password')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="image">تصویر</label>
                <input type="file" wire:model.debounce.500ms="image" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150">
                @error('image')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="is_staff"> کارمند سایت</label>
                <input type="checkbox" wire:model.debounce.500ms="is_staff" class="my-1 rounded border h-4 w-4 outline-none focus:text-white focus:border-blue-500 focus:bg-blue-500 duration-150" placeholder="رمز ورود خود را وارد کنید">
            </div>
            <div class="my-3 flex">
                @if($editActive)
                <button type="button" wire:click="edit({{ $userId }})" class="mx-2 px-3 py-2 bg-yellow-500 hover:bg-yellow-600 duration-150 text-white rounded-xl">ویرایش کاربر</button>
                @else
                <button type="button" wire:click="newUser" class="mx-2 px-3 py-2 bg-green-500 hover:bg-green-600 duration-150 text-white rounded-xl">افزودن کاربر</button>
                @endif
                <button type="button" onclick="toggleElem('#newUserForm')" wire:click="toggleNewUser" class="mx-2 px-3 py-2 bg-red-500 hover:bg-red-600 duration-150 text-white rounded-xl">لغو</button>
            </div>
        </div>
    </div>

    {{-- card:start --}}
    <div class="w-full bg-white rounded-xl border overflow-hidden">
        {{-- card header  --}}
        <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
            <div>
                <button onclick="toggleElem('#newUserForm')" wire:click="toggleNewUser" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 text-white rounded-xl">کاربر جدید</button>
            </div>

            <div class="px-3 py-1 flex border-b">
                <input type="text" class="mx-2 px-3 outline-none bg-gray-50" placeholder="جستجو کنید" wire:model="search">
                <button>
                    <i class="fa fa-search text-xs"></i>
                </button>
            </div>
        </div>
        <hr>

        {{-- card body --}}
        <div class="w-full py-3 px-5 overflow-x-auto">
            <table class="md:w-full w-[700px] overflow-x-auto overflow-y-hidden">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="text-center py-3">#</th>
                        <th class="text-center py-3">نام</th>
                        <th class="text-center py-3">ایمیل</th>
                        <th class="text-center py-3">نوع کاربر</th>
                        <th class="text-center py-3">تصویر</th>
                        <th class="text-center py-3">اقدامات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                            <td class="text-center py-3">{{ $user->name }}</td>
                            <td class="text-center py-3">{{ $user->email }}</td>
                            <td class="text-center py-3">@if($user->is_superuser == 1) <span class="px-2 py-1 rounded bg-yellow-400 text-yellow-700 font-bold text-xs">مدیر سایت</span>  @elseif($user->is_staff) <span class="px-2 py-1 rounded bg-blue-400 text-white font-bold text-xs">کارمند سایت</span> @else <span class="px-2 py-1 rounded bg-gray-300 text-gray-700 font-bold text-xs">کاربر عادی</span> @endif</td>
                            <td class="text-center py-3">
                                <img src="{{ $user->image ? Storage::url($user->image) : asset('assets/images/user/1.png') }}" alt="profile pic" class="w-12">
                            </td>
                            <td class="text-center py-3">
                                @if(!$user->is_superuser == 1)
                                    <button wire:click="editUser({{ $user->id }})" onclick="toggleElem('#newUserForm')" class="px-3 py-2 text-xs rounded-xl bg-yellow-400 text-yellow-800 border border-yellow-400 hover:bg-white hover:text-yellow-500 duration-150">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if($user->id != auth()->user()->id)
                                        <button wire:click="deleteUser({{ $user->id }})" class="px-3 py-2 text-xs rounded-xl bg-red-500 text-white border border-red-500 hover:bg-white hover:text-red-500 duration-150">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>

        {{-- card footer --}}
        <div class="w-full py-3 px-5 bg-gray-50" dir="ltr">
            {{ $users->links('livewire::tailwind') }}
        </div>
    </div>
    {{-- card:end --}}
    @if(session()->has('message'))
        <script>
            Swal.fire({
                title: "{{ session()->get('message') }}",
                icon: 'success'
            })
        </script>
    @endif

</div>

