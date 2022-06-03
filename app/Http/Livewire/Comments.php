<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $search;


    public function render()
    {
        $comments = Comment::query();

        $comments->where('comment', 'LIKE', "%{$this->search}%")->get();

        $comments = $comments->orderBy('approved')->latest()->paginate(20);
        return view('livewire.comments', compact('comments'));
    }


    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        session()->flash('message', 'نظر با موفقیت حذف شد');    
    }

    public function approveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approved = 1;
        $comment->update();

        session()->flash('message', 'نظر با موفقیت تایید شد');
    }
}
