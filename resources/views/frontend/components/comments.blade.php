@foreach ($comments as $comment) 
<div class="mt-5 w-full rounded bg-gray-100 border hover:bg-white hover:border-white hover:shadow duration-150">
    <div class="w-full mb-2 p-3">
        <div class="w-full flex items-center justify-between">
            <div class="flex itesm-center">
                <div class="w-8 h-8 rounded-full bg-gray-400 ml-3 overflow-hidden">
                    <img src="{{ $comment->user->image ? Storage::url($comment->user->image) : asset('assets/images/user/1.png') }}" alt="profile image" class="w-full h-full">
                </div>
                <span>{{ $comment->user->name }}</span>
            </div>
            <div>
                @auth
                    <a href="#comment-form" wire:click="setParent({{ $comment->id }})" class="px-4 py-1 border border-blue-400 hover:bg-blue-400 hover:text-white duration-150 text-blue-400 font-bold text-sm">پاسخ</a>
                @endauth
            </div>
        </div>
    </div>
    <hr>
    <div class="py-3 px-5">
        <p>{{ $comment->comment }}</p>
        @include('frontend.components.comments', ['comments' => $comment->child()->where('approved', 1)->get()])
    </div>
</div>
@endforeach