<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create New User')]
class UserCreate extends Component
{
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.admin.user.user-create');
    }

    /**
     * Create Modal and Reset form and validations
     */
    public function create()
    {
        $this->resetValidation();
        $this->reset();
    }

    /**
     * Save Record
     */
    public function save()
    {
        // Validate data
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:' . User::class,
            'password' => 'required|min:8|max:255',
        ]);

        User::create($validated);

        // Reset Form
        $this->reset();

        // Dispatch a success message
        $this->dispatch('success', 'User has been created successfully!');

        // Dipatch browser event
        // $this->dispatch('created');

        // return $this->redirect(route('admin.users'), navigate: true);
    }
}
