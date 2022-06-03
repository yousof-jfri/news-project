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
        <div class="w-full py-3 px-5 overflow-x-scroll">
            <table class="md:w-full w-[700px] overflow-x-auto overflow-y-hidden ">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="text-center py-3">#</th>
                        <th class="text-center py-3">عنوان</th>
                        <th class="text-center py-3">توضیحات</th>
                        <th class="text-center py-3">بازدید ها</th>
                        <th class="text-center py-3">تصویر</th>
                        <th class="text-center py-3">وضعیت</th>
                        <th class="text-center py-3">اقدامات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topics as $topic)
                        <tr class="hover:bg-gray-100">
                            <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                            <td class="text-center py-3">{{ $topic->title }}</td>
                            <td class="text-center py-3">{{ $topic->description }}</td>
                            <td class="text-center py-3">{{ $topic->views }}</td>
                            <td class="text-center py-3">
                                <img src="{{ Storage::url($topic->image) }}" alt="new image" class="w-12">
                            </td>
                            <td>
                                @if($topic->public)
                                    <span class="text-xs m-auto px-2 py-1 rounded bg-green-500 text-white">منتشر شده</span>
                                @else
                                    <span class="text-xs m-auto px-2 py-1 rounded bg-red-500 text-white">منتشر نشده</span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <button wire:click="deleteTopic({{ $topic->id }})" class="px-3 py-2 text-xs rounded-xl bg-red-500 text-white border border-red-500 hover:bg-white hover:text-red-500 duration-150">
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
            {{ $topics->links('livewire::tailwind') }}
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


