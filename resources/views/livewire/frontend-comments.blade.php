<div class="mt-5">
    <div class="w-full p-10">
        <div>
            <h2 class="md:text-2xl text-xl font-bold">دیدگاه ها</h2>
        </div>
        <div class="mt-5">
            <div class="w-full" id="comment-form">
                @guest
                    <div class="my-3 w-full bg-yellow-200 p-5 font-bold text-yellow-700 rounded">
                        <p>لطفا برای نظر دادن ابتدا وارد سایت شوید</p>
                    </div>
                @else
                    <form wire:submit.prevent="newComment">
                        <input type="hidden" wire:model="parent_id" id="parent_id">
                        <div class="mt-3">
                            <textarea wire:model.debounce.500ms="commentBody" rows="10"  class="w-full rounded px-3 py-2 outline-none border focus:ring focus:ring-blue-300 focus:ring-offset-2 duration-150"></textarea> 
                        </div>
                        @error('commentBody')
                            <span class="text-red-500 mx-5">{{ $message }}</span>
                        @enderror
                        <div class="mt-3">
                            <button type="submit" class="px-3 py-2 bg-blue-400 border border-blue-400 text-white hover:bg-white hover:text-blue-500 duration-150">ثبت دیدگاه</button>
                        </div>
                    </form>
                @endguest
            </div>
        </div>
        <div class="mt-5">
            @include('frontend.components.comments', ['comments' => $news->comments()->where('parent_id', 0)->whereApproved(1)->get()])    
        </div>
    </div>
</div>
