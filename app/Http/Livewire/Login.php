<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    public $email,
    $password,
    $remember = false;


    public function render()
    {
        return view('livewire.login');
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


        // if user data is correct login user and redirect to the / path if not flash a sessions and show error to user
        if(auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)){
            return redirect('/');
        }
        
        session()->flash('error', 'اطلاعات  سازگار نیست');
        
    }


    // validate data
    protected function validateData()
    {
        $this->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8']
        ]);
    }
}
