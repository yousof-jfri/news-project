@foreach ($categories as $category)
    <div class="w-full px-4 py-3 border-r">
        <div class="flex items-center">
            <div class="ml-2">
                <span>{{ $loop->index + 1 }} _</span>
                <span>{{ $category->name }}</span>
            </div>
            <div class="mx-2">
                <button onclick="toggleElem('#newCategoryForm')" wire:click="editCategory({{ $category->id }})" class="px-2 py-1 text-xs rounded-xl bg-yellow-400 text-yellow-800 border border-yellow-400 hover:bg-white hover:text-yellow-500 duration-150">
                    <i class="fa fa-edit"></i>
                </button>
                <button wire:click="deleteCategory({{ $category->id }})" class="px-2 py-1 text-xs rounded-xl bg-red-500 text-white border border-red-500 hover:bg-white hover:text-red-500 duration-150">
                    <i class="fa fa-trash"></i>
                </button>
                <button onclick="toggleElem('#newCategoryForm')" wire:click="newChildCategory({{ $category->id }})" class="px-2 py-1 text-xs rounded-xl bg-green-500 text-white border border-green-500 hover:bg-white hover:text-green-500 duration-150">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        @include('admin.components.categories', ['categories' => $category->child])
    </div>
@endforeach
