<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|min:3|max:20')]
    public $name;
    #[Validate('required|email|min:3')]
    public $email;
    #[Validate('required|min:3')]
    public $password;

    public function submit()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);


        session()->flash('success', 'Account registered successfully');

        $this->redirect('/register');
    }

    public function render()
    {
        return view('register.index');
    }
}
