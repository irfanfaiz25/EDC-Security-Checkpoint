<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WireLogin extends Component
{
    public $username;
    public $password;
    public $rulesLogin = [
        'username' => 'required',
        'password' => 'required'
    ];


    public function loginSubmit()
    {
        $validatedLogin = $this->validate($this->rulesLogin);

        if (
            Auth::attempt([
                'username' => $validatedLogin['username'],
                'password' => $validatedLogin['password']
            ])
        ) {
            return redirect(route('dashboard'));
        } else {
            session()->flash('invalid', 'Invalid login credentials.');
            $this->reset('password');
        }
    }


    public function render()
    {
        return view('livewire.auth.wire-login');
    }
}