<?php

namespace App\Livewire\Forms;

use App\Models\ExternalPersonnel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonnelForm extends Form
{
    public ?ExternalPersonnel $externalPersonnel;

        #[Validate('string|required|max:255|regex:/^[a-zA-Z\s]+$/')]

    public $first_name;

    #[Validate('string|nullable|max:255|regex:/^[a-zA-Z\s]+$/')]
    public $middle_name;

        #[Validate('string|required|max:255|regex:/^[a-zA-Z\s]+$/')]

    public $last_name;

    #[Validate('nullable|digits:11|numeric')]
    public $contact_number;

    #[Validate('nullable|email|max:255')]
    public $email;

    #[Validate('nullable|max:255')]
    public $affiliation;

    public function setForm(ExternalPersonnel $externalPersonnel)
    {
        $this->externalPersonnel = $externalPersonnel;
        $this->first_name = $externalPersonnel->first_name;
        $this->middle_name = $externalPersonnel->middle_name;
        $this->last_name = $externalPersonnel->last_name;
        $this->contact_number = $externalPersonnel->contact_number;
        $this->email = $externalPersonnel->email;
        $this->affiliation = $externalPersonnel->affiliation;
    }

    public function save()
    {
        $this->validate();

        ExternalPersonnel::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'affiliation' => $this->affiliation,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate();
        
        $this->externalPersonnel->update([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'affiliation' => $this->affiliation,
        ]);
        
        $this->reset();
    }

    public function delete()
    {
        $this->externalPersonnel->delete();
        $this->reset();
    }
}
