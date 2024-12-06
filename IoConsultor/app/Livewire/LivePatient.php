<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patient;

class LivePatient extends Component
{
    use WithPagination;

    public $name, $email, $phone, $age;
    public $modalC = false;
    public $modalE = false;
    public $idEditable;
    public $Edit = [
        'id' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'age' => '',
    ];
    public $search = '';

    public function render()
    {
        $patients = Patient::where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%')
                          ->paginate(5);
        return view('livewire.live-patient', [
            'patients' => $patients
        ]);
    }

    public function save()
    {
        $patient = new Patient();
        $patient->name = $this->name;
        $patient->email = $this->email;
        $patient->phone = $this->phone;
        $patient->age = $this->age;
        $patient->save();
        $this->reset(['name','email','phone','age']);
        $this->modalC = false;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'search') {
            $this->resetPage();
        }
    }

    public function delete($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
    }

    public function edit($id)
    {
        $this->modalE = true;
        $patient = Patient::find($id);
        $this->idEditable = $patient->id;
        $this->Edit['id'] = $patient->id;
        $this->Edit['name'] = $patient->name;
        $this->Edit['email'] = $patient->email;
        $this->Edit['phone'] = $patient->phone;
        $this->Edit['age'] = $patient->age;
    }

    public function update()
    {
        $patient = Patient::find($this->idEditable);
        $patient->update([
            'name' => $this->Edit['name'],
            'email' => $this->Edit['email'],
            'phone' => $this->Edit['phone'],
            'age' => $this->Edit['age'],
        ]);
        $this->reset(['Edit', 'idEditable', 'modalE']);
    }
}
