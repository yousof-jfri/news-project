<div>
    <div class="w-full p-5 bg-white rounded shadow">
        <div class="w-full my-1 mx-3">
            <h3 class="text-xl font-bold">مقاله جدید</h3>
        </div>
        <form wire:submit.prevent="submitTopic">
            <div class="mt-5">
                <input type="text" wire:model="title" class="w-full px-5 py-2 border-b md:text-xl @error('title') border-red-500 @enderror outline-none focus:border-blue-300  duration-150" placeholder="عنوان مقاله">
                @error('title')
                    <span class="w-full mx-3 mt-3 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-5">
                <input type="text" wire:model="description" class="w-full px-5 py-2 border-b md:text-xl @error('description') border-red-500 @enderror outline-none focus:border-blue-300  duration-150" placeholder="توضیحات مقاله">
                @error('description')
                    <span class="w-full mx-3 mt-3 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-5">
                <button type="button" class="overflow-hidden px-3 py-2 border @error('image') border-red-500 @enderror bg-white hover:bg-gray-50 duration-150 rounded relative">
                    <span class="mx-2">تصویر مقاله</span>
                    <i class="fa fa-image"></i>
                    <input onchange="setImage(event)" wire:model="image" type="file" class="opacity-0 absolute top-0 left-0">
                </button>
                @error('image')
                    <span class="w-full mx-3 mt-3 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-5">
                <img src="" wire:ignore alt="" class="h-[200px]  w-auto hidden" id="topic-image">
            </div>  
            <div class="mt-5">
                <textarea rows="12" wire:model.debounce.800ms="body" class="w-full @error('body') border-red-500 @enderror px-5 py-2 border-b md:text-xl outline-none focus:border-blue-300  duration-150" placeholder="متن مقاله"></textarea>
                @error('body')
                    <span class="w-full mx-3 mt-3 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-5">
                <label>تگ ها</lable>
                <select rows="12" @error('tags') border-red-500 @enderror class="w-full px-5 py-2 border rounded md:text-xl outline-none focus:border-blue-300  duration-150">
                    @foreach(App\Models\Tag::all() as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-5 flex items-center">
                <label>منتشر شود</lable>
                <input type="checkbox" wire:model="public" class="mx-2"/>
            </div>
            <div class="mt-5 flex justify-between">
                <button type="submit" class="px-3 py-2 bg-green-500 text-white duration-150 hover:bg-green-600 rounded">ذخیره</button>
                <a href="{{ route('admin.profile') }}" class="px-3 py-2 bg-red-500 text-white duration-150 hover:bg-red-600 rounded">لغو</a>
            </div>
        </form>
    </div>
</div>
