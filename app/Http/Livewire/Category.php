<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Category extends Component
{
    use WithPagination;

    public $search;

    public $categoryId, 
        $name,
        $en_name,
        $parentId = 0;
    
    public $createOpen = false;

    public $editActive = false;


    public function render()
    {
        $categories = \App\Models\Category::query();

        if($this->search != ''){
            $categories->where('name', 'LIKE', "%{$this->search}%")->orWhere('en_name', 'LIKE', "%{$this->search}%")->get();
        }

        $categories = $categories->where('parent_id', 0)->paginate(20);

        return view('livewire.category', compact('categories'));
    }

    public function updated()
    {
        $this->validateData();
    }


    // create new category
    public function newCategory()
    {
        // validate data
        $this->validateData();

        // create new category
        $category = \App\Models\Category::create([
            'name' => $this->name,
            'en_name' => $this->en_name,
            'parent_id' => $this->parentId,
            'slug' => Str::slug($this->en_name),
        ]);

        // clear all data
        $this->resetForm();

        // return a response
        session()->flash('message', "دسته بندی با موفقیت ساخته شد");
    }

    // add new category
    public function newChildCategory($id)
    {        
        $this->parentId = $id;

        $this->toggleNewCategory();
    }

    // edit category
    public function editCategory($id)
    {
        $category = \App\Models\Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->en_name = $category->en_name;
        $this->parentId = $category->parent_id;
        
        $this->createOpen = true;

        $this->editActive = true;
    }

    // edit Category
    public function edit($id)
    {
        $data = $this->validateData();

        // find category from Data base
        $category = \App\Models\Category::findOrFail($id);


        // update category
        $category->update([
            'name' => $data['name'],
            'en_name' => $data['en_name'],
            'parent_id' => $this->parentId,
            'slug' => Str::slug($data['en_name']),
        ]);

        session()->flash('message', "دسته بندی با موفقیت ویرایش شد");

        $this->resetForm();
    }

    // delete category from data base
    public function deleteCategory($id)
    { 
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        session()->flash('message', 'دسته بندی با موفقیت حذف شد');
    }


    public function toggleNewCategory()
    {
        if($this->createOpen == true){
            $this->resetForm();
            $this->createOpen = false;
        }else {
            $this->createOpen = true;
        }
        $this->editActive = false;
    }

    // validate new category
    public function validateData(){
        return $this->validate([
            'name' => ['required', 'max:100'],
            'en_name' => ['required', 'max:100'],
            'parentId' => '',
        ]);
    }

    // reset every thing
    protected function resetForm()
    {
        $this->createOpen = false;
        $this->editActive = false;
        $this->categoryId = 0;
        $this->name = '';
        $this->en_name = '';
        $this->parentId = 0;
    }
}
