<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Doctor;

class LiveDoctor extends Component
{
    use WithPagination;

    public $name, $email;
    public $modalC = false;
    public $modalE = false;
    public $idEditable;
    public $Edit = [
        'id' => '',
        'name' => '',
        'email' => '',
    ];
    public $search = '';

    public function render()
    {
        $doctors = Doctor::where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%')
                          ->paginate(5);
        return view('livewire.live-doctor', [
            'doctors' => $doctors
        ]);
    }

    public function save()
    {
        $doctor = new Doctor();
        $doctor->name = $this->name;
        $doctor->email = $this->email;
        $doctor->save();
        $this->reset(['name', 'email']);
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
        $doctor = Doctor::find($id);
        $doctor->delete();
    }

    public function edit($id)
    {
        $this->modalE = true;
        $doctor = Doctor::find($id);
        $this->idEditable = $doctor->id;
        $this->Edit['id'] = $doctor->id;
        $this->Edit['name'] = $doctor->name;
        $this->Edit['email'] = $doctor->email;
    }

    public function update()
    {
        $doctor = Doctor::find($this->idEditable);
        $doctor->update([
            'name' => $this->Edit['name'],
            'email' => $this->Edit['email'],
        ]);
        $this->reset(['Edit', 'idEditable', 'modalE']);
    }
}
