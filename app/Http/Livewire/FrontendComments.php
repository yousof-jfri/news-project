<?php

namespace App\Http\Livewire;
use App\Models\Comment;
use Livewire\Component;

class FrontendComments extends Component
{
    public $parent_id = 0;
    public $news;
    public $commentBody;

    public function render()
    {
        return view('livewire.frontend-comments');
    }

    public function updated()
    {
        $this->validateData();
    }

    public function newComment()
    {
        $this->validateData();
        $class = get_class($this->news);
        auth()->user()->comments()->create([
            'comment' => $this->commentBody,
            'commentable_id' => $this->news->id,
            'commentable_type' => $class,
            'parent_id' => $this->parent_id,
        ]);
        $this->resetForm();
        session()->flash('message', 'نظر با موفقیت اضافه شد لطفا منتظر تاید شدن ان باشید');
    }

    protected function validateData()
    {
        return $this->validate([
            'parent_id' => ['required'],
            'commentBody' => ['required', 'min:2'],
        ]);
    }

    protected function resetForm()
    {
        $this->parent_id = 0;
        $this->commentBody = '';
    }

    public function setParent($id)
    {
        $this->parent_id = $id;
    }

}
