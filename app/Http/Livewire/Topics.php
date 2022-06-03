<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Topic;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Topics extends Component
{
    use WithPagination;

    public $search;


    public function render()
    {
        $topics = Topic::query();

        $topics->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")->get();

        $topics = $topics->latest()->paginate(10);

        return view('livewire.topics', compact('topics'));
    }

    // delete topic from data base
    public function deleteTopic($id)
    { 
        $topic = Topic::findOrFail($id);

        if(File::exists(public_path(Storage::url($topic->image)))){
            File::delete(public_path(Storage::url($topic->image)));
        }

        $topic->delete();

        session()->flash('message', 'مقاله با موفقیت حذف شد');
    }
}
