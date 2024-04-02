<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users List')]
class UserList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $perPage = 10;

    public $id;

    // record to delete
    public $recordToDelete;

    /**
     * Render placeholder
     */
    // public function placeholder()
    // {
    // }

    /**
     * Main Blade Render
     */
    public function render()
    {
        $query = User::query();

        // Get all columns in the users table
        $columns = Schema::getColumnListing('users');

        // Filter users based on search query
        if ($this->search !== '') {
            $query->where(function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate($this->perPage);

        return view('livewire.admin.user.user-list', [
            'users' => $users
        ]);
    }

    /**
     * Reset Search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Update perPage records
     */
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    /**
     * Toggle User Status
     */
    public function toggleUserStatus($userId)
    {
        // Get user data
        $user = User::find($userId);
        
        // Check user exists
        if (!$user) {
            $this->dispatch('error', 'User not found!');
            return;
        }

        // Change Status
        $user->update(['is_active' => !$user->is_active]);

        // Dispatch a success message
        $this->dispatch('success', 'User status has been updated successfully!');

    }

    /**
     * Confirm Delete
     */
    public function confirmDelete($id)
    {
        $this->recordToDelete = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    /**
     * Cancel delete action
     */
    public function cancelDelete()
    {
        $this->dispatch('hideDeleteConfirmation');
    }

    /**
     * Delete Record
     */
    public function delete()
    {
        // Check if a record to delete is set
        if (!$this->recordToDelete) {
            $this->dispatch('error', 'No user selected for deletion.');
            return;
        }

        // get id
        $user = User::find($this->recordToDelete);

        // Check record exists
        if (!$user) {
            $this->dispatch('hideDeleteConfirmation');
            return;
        }
        // Delete record
        $user->delete();

        // Dispatch a success message
        $this->dispatch('success', 'User has been deleted successfully!');

        // dispatch browser event
        $this->dispatch('deleted');

        // Reset the record to delete
        $this->recordToDelete = null;

        // refresh the records table
        $this->render();
    }
}
