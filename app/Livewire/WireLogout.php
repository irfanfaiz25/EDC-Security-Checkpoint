<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WireLogout extends Component
{

    public function logout()
    {
        Auth::logout();

        return redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.auth.wire-logout');
    }
}