<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;

    public $userId, 
        $name,
        $password,
        $email,
        $image,
        $is_staff = false;
    
    public $createOpen = false;

    public $editActive = false;


    public function render()
    {
        $users = User::query();

        $users->where('name', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%")->get();

        $users = $users->latest()->paginate(30);

        return view('livewire.users', compact('users'));
    }

    public function updated()
    {
        $this->validateData();
    }


    // create new user
    public function newUser()
    {
        // validate data
        $this->validateData();

        $image = null;
        if($this->image)
        {
            $image = $this->image->store('public/users/profile');
        }

        // create new user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'image' => $image,
            'password' => bcrypt($this->password),
            'is_staff' => $this->is_staff,
        ]);

        // clear all data
        $this->resetForm();

        // return a response
        session()->flash('message', "کاربر با موفقیت ساخته شد");
    }

    // edit user
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_staff = $user->is_staff;
        $this->userId = $user->id;
        
        $this->createOpen = true;

        $this->editActive = true;
    }

    public function edit($id)
    {
        $data = $this->validateData();

        // find user from Data base
        $user = User::findOrFail($id);

        $image = $user->image;
        if($this->image){
            // dd(File::exists(public_path(Storage::url($user->image))));
            if(File::exists(public_path(Storage::url($user->image)))){
                File::delete(public_path(Storage::url($user->image)));
            }
            $image = $this->image->store('public/users/profile');
        }
        
        // if user did not choose a password, store the prev password
        if(!isset($data['password'])){
            $data['password'] = $user->password;
        }else {
            $data['password'] = bcrypt($data['password']);
        }

        // update user
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_staff' => $this->is_staff,
            'image' => $image,
        ]);

        session()->flash('message', "کاربر با موفقیت ویرایش شد");

        $this->resetForm();
    }

    // delete user from data base
    public function deleteUser($id)
    { 
        $user = User::findOrFail($id);
        if(File::exists(public_path(Storage::url($user->image)))){
            File::delete(public_path(Storage::url($user->image)));
        }
        $user->delete();

        session()->flash('message', 'کاربر با موفقیت حذف شد');
    }


    public function toggleNewUser()
    {
        if($this->createOpen == true){
            $this->createOpen = false;
            $this->resetForm();
        }else {
            $this->createOpen = true;
        }
        $this->editActive = false;
    }

    // validate new user
    public function validateData(){
        return $this->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', $this->editActive ? Rule::unique('users', 'email')->ignore($this->userId) : 'unique:users,email'],
            'password' => [$this->editActive ? 'nullable' : 'required' , 'min:8'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
        ]);
    }

    // reset every thing
    protected function resetForm()
    {
        $this->createOpen = false;
        $this->editActive = false;
        $this->userId = 0;
        $this->image = '';
        $this->name = '';
        $this->email = '';
        $this->is_staff = false;
        $this->userId = '';
    }
}
