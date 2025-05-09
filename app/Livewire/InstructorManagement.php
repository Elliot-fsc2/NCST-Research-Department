<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Mary\Traits\Toast;

class InstructorManagement extends Component
{
    use Toast;
    public $search;
    public bool $switch = true;

    public function toggle($user)
    {
        dd($user);
        return false;
    }
    public $sortBy = ['column' => 'id', 'direction' => 'asc'];
    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'first_name', 'label' => 'First Name'],
        ['key' => 'middle_name', 'label' => 'Middle Name'],
        ['key' => 'last_name', 'label' => 'Last Name'],
        ['key' => 'department.name', 'label' => 'Department'],
        ['key' => 'handledSections', 'label' => 'No. of Groups Handle'],
        ['key' => 'is_active', 'label' => 'Status'],
    ];

    public function user(): LengthAwarePaginator
    {
        return User::query()
            ->where('role', 'professor')
            ->with([
                'handledSections',
                'department',
            ])
            ->when($this->search, function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);
    }

    public function toggleStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
    
        $status = $user->is_active ? 'activated' : 'deactivated';
    
        $this->success("Instructor {$status} successfully");
    }
    


    public function render()
    {
        $users = $this->user();
        return view('livewire.instructor-management', compact('users'));
    }
}
