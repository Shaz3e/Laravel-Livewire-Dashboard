<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserShow extends Component
{
    public $id, $name, $email;

    public function mount($id)
    {
        $this->id = $id;
        $user = User::find($id);

        if(!$user){
            return $this->redirect(route('admin.users'));
        }

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.admin.user.user-show');
    }
}
