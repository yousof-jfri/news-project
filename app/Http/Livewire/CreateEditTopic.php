<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Topic;

class CreateEditTopic extends Component
{
    use WithFileUploads;

    public $title,
        $description,
        $image,
        $body,
        $tags,
        $public = false;

    public function render()
    {
        return view('livewire.create-edit-topic');
    }

    public function submitTopic()
    {
        $this->validateData();

        // store image
        $image = $this->image->store('public/topics/posters');

        // set slug
        $slug = Str::slug($this->title);

        // store topic
        auth()->user()->topics()->create([
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'slug' => $slug,
            'image' => $image,
            'public' => $this->public,
        ]);

        session()->flash('message', 'مقاله شما با موفقیت ذخیره شد');

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
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'body' => 'required',
            'tags' => ['nullable'],
            'public' => 'boolean',
        ]);
    }
}
