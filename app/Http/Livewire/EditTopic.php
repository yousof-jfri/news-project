<?php

namespace App\Http\Livewire;

use App\Models\Topic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EditTopic extends Component
{
    use WithFileUploads;

    public $topicId, 
        $title,
        $description,
        $image,
        $body,
        $tags,
        $public = false;

    public function render()
    {
        return view('livewire.edit-topic');
    }

    public function mount($topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $this->topicId = $topic->id;
        $this->title = $topic->title;
        $this->description = $topic->description;
        $this->body = $topic->body;
        $this->public = $topic->public;
        $this->image = '';
    }

    public function submitTopic()
    {
        $this->validateData();

        $topic = Topic::findOrFail($this->topicId);

        // store image
        $image = $topic->image;
        if($this->image)
        {
            if(File::exists(public_path(Storage::url($topic->image)))){
                File::delete(public_path(Storage::url($topic->image)));
            }
            $image = $this->image->store('public/topics/posters');
        }

        // set slug
        $slug = Str::slug($this->title);

        // store topic
        $topic->update([
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'slug' => $slug,
            'image' => $image,
            'public' => $this->public,
        ]);

        session()->flash('message', 'مقاله شما با موفقیت ویرایش شد');

        // redirect to the profile
        return redirect()->route('admin.profile');
    }

    public function updated()
    {
        $this->validateData();
    }

    public function validateData()
    {
        return $this->validate([
            'title' => ['required', 'min:4'],
            'description' => ['required', 'max:255'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
            'body' => 'required',
            'tags' => ['nullable'],
            'public' => 'boolean',
        ]);
    }
}
