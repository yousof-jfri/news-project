<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;

class Newses extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;

    public $ckeditor = true;

    public $newsId,
        $title,
        $description,
        $body,
        $image,
        $public = false,
        $is_supernews = false,
        $category_id;
    
    public $createOpen = false;

    public $editActive = false;


    public function render()
    {
        $newses = News::query();

        $newses->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")->get();

        $newses = $newses->latest()->paginate(10);

        return view('livewire.newses', compact('newses'));
    }

    public function updated()
    {
        $this->validateData();
    }


    // create new news
    public function newNews()
    {
        // validate data
        $this->validateData();

        if($this->image){
            $image = $this->image->store('public/newses/poster');
        }

        $slug = Str::slug($this->title);

        // create new news
        $news = News::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description,
            'body' => $this->body,
            'image' => $image,
            'public' => $this->public,
            'is_supernews' => $this->is_supernews,
            'category_id' => $this->category_id,
        ]);

        // clear all data
        $this->resetForm();

        // return a response
        session()->flash('message', "خبر با موفقیت درج شد");
    }

    // edit news
    public function editNews($id)
    {
        $news = News::findOrFail($id);

        $this->newsId = $news->id;
        $this->title = $news->title;
        $this->description = $news->description;
        $this->body = $news->body;
        $this->public = $news->public;
        $this->is_supernews = $news->is_supernews;
        $this->category_id = $news->category_id;
        
        
        $this->createOpen = true;

        $this->editActive = true;
    }

    public function edit($id)
    {
        $data = $this->validateData();
        
        // find news from Data base
        $news = News::findOrFail($id);

        // 
        $img = $news->image;
        if($this->image){
            if(File::exists(public_path(Storage::url($news->image)))){
                File::delete(public_path(Storage::url($news->image)));
            }
            $img = $this->image->store('public/newses/poster');
        }

        $slug = Str::slug($this->title);

        // update news
        $news->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'body' => $data['body'],
            'slug' => $slug,
            'image' => $img,
            'public' => $data['public'],
            'is_supernews' => $data['is_supernews'],
            'category_id' => $data['category_id'],
        ]);

        session()->flash('message', "خبر با موفقیت ویرایش شد");

        $this->resetForm();
    }

    // delete news from data base
    public function deleteNews($id)
    { 
        $news = News::findOrFail($id);

        if(File::exists(public_path(Storage::url($news->image)))){
            File::delete(public_path(Storage::url($news->image)));
        }

        $news->delete();

        session()->flash('message', 'خبر با موفقیت حذف شد');
    }


    public function toggleNewNews()
    {
        if($this->createOpen == true){
            $this->createOpen = false;
        }else {
            $this->createOpen = true;
        }
        $this->editActive = false;
    }

    // validate new news
    public function validateData(){
        return $this->validate([
            'title' => 'required',
            'description' => 'nullable',
            'body' => 'required',
            'image' => $this->editActive ? 'nullable' : 'required',
            'public' => ['boolean'],
            'is_supernews' => ['boolean'],
            'category_id' => 'required',
        ]);
    }

    // reset every thing
    protected function resetForm()
    {
        $this->createOpen = false;
        $this->editActive = false;
        $this->newsId = 0;
        $this->title = '';
        $this->description = '';
        $this->body = '';
        $this->image = '';
        $this->public = '';
        $this->is_supernews = '';
        $this->category_id = '';
    }
}
