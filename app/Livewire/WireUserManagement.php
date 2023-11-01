<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class WireUserManagement extends Component
{

    use WithFileUploads;


    public $searchUsers;
    public $name;
    public $username;
    public $password;
    public $department;
    public $foto;


    public $isDepartment = false;

    public $departmentsList;

    public $rules = [
        'name' => 'required|min:5|max:50',
        'username' => 'required|min:2|max:20|unique:users',
        'password' => 'required|min:5',
        'department' => 'required',
        'foto' => 'required|image|max:2048'
    ];

    public function setDepartmentFalse()
    {
        $this->isDepartment = false;
    }

    public function updatedDepartment($value)
    {
        if ($value == 'add-new') {
            $this->isDepartment = true;
            $this->department = '';
        }
    }

    public function addUser()
    {
        $validatedData = $this->validate($this->rules);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['foto'] = $this->storeImage($validatedData['username']);

        $validatedData['department'] = ucwords($validatedData['department']);

        try {
            User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'password' => $validatedData['password'],
                'department' => $validatedData['department'],
                'foto' => $validatedData['foto']
            ]);

            $this->reset('name', 'username', 'password', 'department', 'foto');

            $this->isDepartment = false;

            session()->flash('successUser', 'User created successfully!');

            $this->dispatch('newUserAdded');
        } catch (\Exception $e) {
            session()->flash('errorUser', 'User creation failed.');
        }
    }

    public function storeImage($name)
    {
        $userName = $name;
        $currentDate = Carbon::now()->format('Y-m-d H:i:s');

        if ($this->foto) {
            $imageName = $this->foto;
            $imageExtension = $imageName->extension();
            $newImageName = $userName . '_' . $currentDate . '.' . $imageExtension;
            $this->foto->storeAs('public/img/user-image', $newImageName);
            return $newImageName;
        }

        return null;
    }

    public function render()
    {
        $this->departmentsList = User::distinct()->pluck('department');

        $users = User::latest()
            ->where('username', 'like', '%' . $this->searchUsers . '%')
            ->orWhere('name', 'like', '%' . $this->searchUsers . '%')
            ->paginate(5);

        return view('livewire.wire-user-management', [
            'users' => $users
        ]);
    }
}