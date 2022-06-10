<div>
    <div>
        {{-- card:start --}}
        <div class="w-full bg-white rounded-xl border overflow-hidden">
            {{-- card header  --}}
            <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
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
                            <th class="text-center py-3">نظر</th>
                            <th class="text-center py-3">کاربر</th>
                            <th class="text-center py-3">وضعیت</th>
                            <th class="text-center py-3">تاریخ</th>
                            <th class="text-center py-3">اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr class="hover:bg-gray-100">
                                <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                                <td class="text-center py-3">{{ $comment->comment }}</td>
                                <td class="text-center py-3">{{ $comment->user->name }}</td>
                                <td class="text-center py-3"> @if($comment->approved) <span class="px-2 py-1 rounded bg-green-500 text-white text-xs">تایید شده</span> @else <span class="px-2 py-1 rounded bg-red-500 text-white text-xs">تایید نشده</span> @endif</td>
                                <td class="text-center py-3">{{ $comment->created_at }}</td>
                                <td class="text-center py-3">
                                    <button wire:click="approveComment({{ $comment->id }})" class="px-3 py-2 text-xs rounded-xl bg-blue-400 text-white border border-blue-400 hover:bg-white hover:text-blue-500 duration-150">
                                        <span>تایید</span>
                                    </button>
                                 
                                    <button wire:click="deleteComment({{ $comment->id }})" class="px-3 py-2 text-xs rounded-xl bg-red-500 text-white border border-red-500 hover:bg-white hover:text-red-500 duration-150">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
    
            {{-- card footer --}}
            <div class="w-full py-3 px-5 bg-gray-50" dir="ltr">
                {{ $comments->links('livewire::tailwind') }}
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
</div>
