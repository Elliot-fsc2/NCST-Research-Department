<?php

namespace App\Livewire;

use App\Livewire\Forms\PersonnelForm;
use App\Models\ExternalPersonnel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class PersonnelManagement extends Component
{
    use WithPagination, Toast;

    public PersonnelForm $personnelForm;
    public $personnel;
    public $search;
    public $addPersonnel = false;
    public $updatePersonnel = false;
    public $deletePersonnel = false;

    public $sortBy = ['column' => 'first_name', 'direction' => 'asc'];
    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'first_name', 'label' => 'First Name'],
        ['key' => 'middle_name', 'label' => 'Middle Name'],
        ['key' => 'last_name', 'label' => 'Last Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'contact_number', 'label' => 'Contact Number'],
        ['key' => 'affiliation', 'label' => 'Affilation'],
    ];

    public function users(): LengthAwarePaginator
    {
        return ExternalPersonnel::query()
            ->when(
                $this->search,
                fn(Builder $q) =>
                $q->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
            )
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);
    }

    public function add(){
        $this->addPersonnel = true;
        $this->personnelForm->reset();
    }
    public function save()
    {
        $this->personnelForm->save();
        $this->success('Personnel has been added successfully');
        $this->addPersonnel = false;
    }

    public function update(){
        $this->personnelForm->update();
        $this->success('Personnel has been updated successfully');
        $this->updatePersonnel = false;
    }

    public function delModal(ExternalPersonnel $personnel){
        $this->personnel = $personnel->fullName();
        $this->personnelForm->setForm($personnel);
        $this->deletePersonnel = true;
    }

    public function delete()
    {
        $this->personnelForm->delete();
        $this->success('Personnel has been deleted successfully');
        $this->deletePersonnel = false;
    }

    public function edit(ExternalPersonnel $personnel)
    {
        // dd($personnel);
        $this->personnelForm->setForm($personnel);
        $this->updatePersonnel = true;
    }

    public function render()
    {
        $personnels = $this->users();

        return view('livewire.personnel-management', compact('personnels'));
    }
}
