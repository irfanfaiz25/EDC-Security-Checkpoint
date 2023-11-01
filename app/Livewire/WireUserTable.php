<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WireUserTable extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $searchUsers;

    public $name;
    public $username;
    public $password;
    public $department;
    public $foto;

    public $isDepartmentEdit = false;
    public $isEdit = false;
    public $userId;
    public $isChangePassword = false;

    public $departmentsList;
    public $rules = [
        'name' => 'required|min:5|max:50',
        'username' => 'required|min:2|max:20|unique:users',
        'password' => 'nullable|min:5',
        'department' => 'required',
        'foto' => 'nullable|image|max:2048'
    ];


    public function updatingSearchUsers()
    {
        $this->gotoPage(1);
    }

    public function rules()
    {
        $rules = $this->rules;

        if ($this->isEdit) {
            $rules['username'] = [
                'required',
                'min:2',
                'max:20',
                Rule::unique('users')->ignore($this->userId, 'id'),
            ];

            if ($this->isChangePassword) {
                $rules['password'] = 'required|min:5';
            }

            if (!empty($this->foto)) {
                $rules['foto'] = 'required|max:2048';
            }

            return $rules;
        }
        return null;
    }

    public function setDepartmentEditFalse()
    {
        $this->isDepartmentEdit = false;
    }

    public function updatedDepartment($value)
    {
        if ($value == 'add-new') {
            $this->isDepartmentEdit = true;
            $this->department = '';
        }
    }

    public function setEdit($id)
    {
        $user = User::where('id', $id)->first();

        $name = $user->name;
        $username = $user->username;
        $password = $user->password;
        $department = $user->department;
        $image = $user->foto;

        $this->name = $name;
        $this->username = $username;
        // $this->password = $password;
        $this->department = $department;
        $this->foto = $image;

        $this->isEdit = true;

        $this->userId = $id;
    }

    public function cancelEdit()
    {
        $this->isEdit = false;
        $this->userId = '';
    }

    public function setChangePasswordTrue()
    {
        $this->isChangePassword = true;
    }

    public function setChangePasswordFalse()
    {
        $this->isChangePassword = false;
    }

    public function updateUser()
    {
        $id = $this->userId;

        $validatedData = $this->validate($this->rules());

        $user = User::where('id', $id)->first();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            $validatedData['password'] = $user->password;
        }

        if (!empty($validatedData['foto']) && $validatedData['foto'] != $user->foto) {
            $validatedData['foto'] = $this->storeImage($validatedData['username']);
        } else {
            $validatedData['foto'] = $user->foto;
        }

        $validatedData['department'] = ucwords($validatedData['department']);

        $user->update([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'department' => $validatedData['department'],
            'foto' => $validatedData['foto']
        ]);

        $this->isEdit = false;

        $this->isChangePassword = false;

        $this->reset('userId', 'foto', 'name', 'username', 'password', 'department');

        session()->flash('successUser', 'User updated !');
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

    public function deleteUser($id)
    {
        User::where('id', $id)
            ->delete();

        session()->flash('successUser', 'User deleted !');
    }

    #[On('newUserAdded')]
    public function render()
    {
        $this->departmentsList = User::distinct()->pluck('department');

        $users = User::latest()
            ->where('username', 'like', '%' . $this->searchUsers . '%')
            ->orWhere('name', 'like', '%' . $this->searchUsers . '%')
            ->paginate(5);

        return view('livewire.wire-user-table', compact('users'));
    }
}