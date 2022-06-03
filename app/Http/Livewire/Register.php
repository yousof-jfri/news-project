<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public $name,
        $email,
        $password,
        $password_confirmation;



    public function render()
    {
        return view('livewire.register');
    }

    public function updated()
    {
        $this->validateData();
    }


    // login
    public function login()
    {
        // check if the user is validated or not
        $this->validateData();

        // bcrypt password
        $this->password = bcrypt($this->password);
        
        // create new user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        // login user
        auth()->loginUsingId($user->id);
        
        return redirect('/');
    }

    // validate data
    protected function validateData()
    {
        $this->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    }

    

}
