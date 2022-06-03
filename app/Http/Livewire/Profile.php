<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\User;

class Profile extends Component
{

    public $userId, 
        $name,
        $email,
        $image,
        $bio,
        $password;

    public $editActive = false;

    public function render()
    {
        return view('livewire.profile');
    }

    public function updateUser()
    {
        $this->validateData();

        $user = User::find(auth()->user()->id);

        $password = $user->password;
        if($this->password != null)
        {
            $password = bcrypt($this->password);
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
            'bio' => $this->bio,
        ]);

        $this->editActive = false;
        session()->flash('message', 'پروفایل با موفقیت ویرایش شد');
        
    }
    
    public function mount()
    {
        $user = auth()->user();
        $this->setData($user);
    }

    public function updated()
    {
        $this->validateData();
    }

    public function editStart()
    {
        $this->editActive = true;
    }

    public function cancel()
    {
        $this->editActive = false;
        $user = auth()->user();
        $this->setData($user);
    }

    protected function setData($user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
        $this->bio = $user->bio;
    }

    
    protected function validateData()
    {
        return $this->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'bio' => 'nullable',
            'password' => ['nullable', 'min:8'],
        ]);
    }
}
