<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit User')]
class UserEdit extends Component
{
    public $id, $name, $email, $password;

    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }

    /**
     * Edi Model
     */
    public function mount($id)
    {
        $this->id = $id;

        $user = User::find($id);

        if (!$user) {
            return $this->redirect(route('admin.users'));
        }

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
    }

    /**
     * Update Record
     */
    public function update()
    {
        // Validate data
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:' . User::class . ',email,' . $this->id,
            'password' => 'nullable|min:8|max:255',
        ]);

        // If password is not provided, remove it from the validated data
        $emptyValidated = empty($validated['password']);
        if ($emptyValidated) {
            unset($validated['password']);
        }

        // Save the user
        $user = User::find($this->id);
        $user->update($validated);

        // Reset Form
        $this->reset();

        // Dispatch a success message
        $this->dispatch('success', 'User has been updated successfully!');

        // Dispatch browser event to close modal
        $this->dispatch('updated');
    }
}
