<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate('required|email|min:3')]
    public $email;
    #[Validate('required|min:3')]
    public $password;

    public function submit()
    {
        $this->validate();

        if (Auth::attempt($this->only(['email', 'password']))) {
            session()->regenerate();

            return redirect('/dashboard');
        }
        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        if (Auth::check()) {
            $this->redirect('/dashboard');
        }

        return view('login.index');
    }
}
