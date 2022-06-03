<div>
    <div>

        <div id="newCategoryForm" class="w-full bg-white rounded-xl border overflow-hidden mb-5 @if(!$createOpen) hidden @endif">
            {{-- card:header --}}
            <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
                @if($editActive)
                <h3 class="text-xl font-bold">ویرایش دسته بندی</h3>
                @else
                <h3 class="text-xl font-bold">دسته بندی جدید</h3>
                @endif
            </div>
    
            {{-- card body --}}
            <div class="w-full py-3 px-5 overflow-x-auto">
                <div class="my-3">
                    <label for="name">نام</label>
                    <input type="text" wire:model.debounce.500ms="name" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="نام دسته بندی را وارد کنید">
                    @error('name')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="en_name">نام انگلیسی</label>
                    <input type="text" wire:model.debounce.500ms="en_name" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" placeholder="نام انگلیسی دسته بندی را وارد کنید">
                    @error('en_name')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3">
                    <label for="parent_id">دسته پدر</label>
                    <select wire:model="parentId" class="w-full my-1 rounded border px-3 py-2 outline-none focus:px-5 focus:border-blue-500 duration-150" id="parent_id">
                        <option value="0">ندارد</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" @selected($parentId == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('parentId')
                        <span class="my-2 mr-5 text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-3 flex">
                    @if($editActive)
                        <button type="button" wire:click="edit({{ $categoryId }})" class="mx-2 px-3 py-2 bg-yellow-500 hover:bg-yellow-600 duration-150 text-white rounded-xl">ویرایش دسته بندی</button>
                    @else
                    <button type="button" wire:click="newCategory" class="mx-2 px-3 py-2 bg-green-500 hover:bg-green-600 duration-150 text-white rounded-xl">افزودن دسته بندی</button>
                    @endif
                    <button type="button" onclick="toggleElem('#newCategoryForm')" wire:click="toggleNewCategory" class="mx-2 px-3 py-2 bg-red-500 hover:bg-red-600 duration-150 text-white rounded-xl">لغو</button>
                </div>
            </div>
        </div>
    
        {{-- card:start --}}
        <div class="w-full bg-white rounded-xl border overflow-hidden">
            {{-- card header  --}}
            <div class="w-full py-3 px-5 bg-gray-50 flex justify-between">
                <div>
                    <button onclick="toggleElem('#newCategoryForm')" wire:click="toggleNewCategory" class="px-3 py-2 bg-blue-500 hover:bg-blue-600 duration-150 text-white rounded-xl">دسته بندی جدید</button>
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
                {{-- categories:start --}}
                @include('admin.components.categories', ['categories' => $categories])
                {{-- categories:end --}}
            </div>
            <hr>
    
            {{-- card footer --}}
            <div class="w-full py-3 px-5 bg-gray-50" dir="ltr">
                {{ $categories->links('livewire::tailwind') }}
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
