<div>

    <div id="newNewsForm" class="w-full bg-white rounded-xl border overflow-hidden mb-5 @if(!$createOpen) hidden @endif">
        {{-- card:header --}}
        <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
            @if($editActive)
            <h3 class="text-xl font-bold">ویرایش خبر</h3>
            @else
            <h3 class="text-xl font-bold">خبر جدید</h3>
            @endif
        </div>

        {{-- card body --}}
        <div class="w-full py-3 px-5 overflow-x-auto">
            <div class="my-3">
                <label for="title">عنوان</label>
                <input type="text" wire:model.debounce.500ms="title" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="عنوان خبر را وارد کنید">
                @error('title')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="description">توضیحات</label>
                <textarea wire:model.debounce.500ms="description" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="توضیحات خبر را وارد کنید"></textarea>
                @error('description')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <label for="body">خبر</label>
                <textarea id="newsTextArea" rows="8" wire:model="body" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150"></textarea>
                @error('body')
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
                <label for="public">عمومی</label>
                <input type="checkbox" wire:model.debounce.500ms="public" class="my-1 rounded border h-4 w-4 outline-none focus:text-white focus:border-blue-500 focus:bg-blue-500 duration-150">
            </div>
            <div class="my-3">
                <label for="is_supernews">خبر فوری</label>
                <input type="checkbox" wire:model.debounce.500ms="is_supernews" class="my-1 rounded border h-4 w-4 outline-none focus:text-white focus:border-blue-500 focus:bg-blue-500 duration-150">
            </div>
            <div class="my-3">
                <label for="category_id">دسته بندی</label>
                <select wire:model.debounce.500ms="category_id" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150">
                    @foreach(App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3 flex">
                @if($editActive)
                <button type="button" wire:click="edit({{ $newsId }})" class="mx-2 px-3 py-2 bg-yellow-500 hover:bg-yellow-600 duration-150 text-white rounded-xl">ویرایش خبر</button>
                @else
                <button type="button" wire:click="newNews" class="mx-2 px-3 py-2 bg-green-500 hover:bg-green-600 duration-150 text-white rounded-xl">افزودن خبر</button>
                @endif
                <button type="button" onclick="toggleElem('#newNewsForm')" wire:click="toggleNewNews" class="mx-2 px-3 py-2 bg-red-500 hover:bg-red-600 duration-150 text-white rounded-xl">لغو</button>
            </div>
        </div>
    </div>

    {{-- card:start --}}
    <div class="w-full bg-white rounded-xl border overflow-hidden">
        {{-- card header  --}}
        <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
            <div>
                <button onclick="toggleElem('#newNewsForm')" wire:click="toggleNewNews" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 text-white rounded-xl">خبر جدید</button>
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
                    @foreach ($newses as $news)
                        <tr class="hover:bg-gray-100">
                            <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                            <td class="text-center py-3">{{ $news->title }}</td>
                            <td class="text-center py-3">{{ Str::limit($news->description, 20, '...') }}</td>
                            <td class="text-center py-3">{{ $news->views }}</td>
                            <td class="text-center py-3">
                                <img src="{{ Storage::url($news->image) }}" alt="new image" class="w-12">
                            </td>
                            <td>
                                @if($news->public)
                                <span class="text-xs m-auto px-2 py-1 rounded bg-green-500 text-white">منتشر شده</span>
                                @else
                                <span class="text-xs m-auto px-2 py-1 rounded bg-red-500 text-white">منتشر نشده</span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <button wire:click="editNews({{ $news->id }})" onclick="toggleElem('#newNewsForm')" class="px-3 py-2 text-xs rounded-xl bg-yellow-400 text-yellow-800 border border-yellow-400 hover:bg-white hover:text-yellow-500 duration-150">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button wire:click="deleteNews({{ $news->id }})" class="px-3 py-2 text-xs rounded-xl bg-red-500 text-white border border-red-500 hover:bg-white hover:text-red-500 duration-150">
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
            {{ $newses->links('livewire::tailwind') }}
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


