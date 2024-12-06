<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Medication;

class LiveMedication extends Component
{
    use WithPagination;

    public $name, $description, $dosage;
    public $modalC = false;
    public $modalE = false;
    public $idEditable;
    public $Edit = [
        'id' => '',
        'name' => '',
        'description' => '',
        'dosage' => '',
    ];
    public $search = '';

    public function render()
    {
        $medications = Medication::where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('description', 'like', '%' . $this->search . '%')
                                ->paginate(5);

        return view('livewire.live-medication', [
            'medications' => $medications
        ]);
    }

    public function save()
    {
        $medication = new Medication();
        $medication->name = $this->name;
        $medication->description = $this->description;
        $medication->dosage = $this->dosage;
        $medication->save();

        $this->reset(['name', 'description', 'dosage']);
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
        $medication = Medication::find($id);
        $medication->delete();
    }

    public function edit($id)
    {
        $this->modalE = true;
        $medication = Medication::find($id);
        $this->idEditable = $medication->id;
        $this->Edit['id'] = $medication->id;
        $this->Edit['name'] = $medication->name;
        $this->Edit['description'] = $medication->description;
        $this->Edit['dosage'] = $medication->dosage;
    }

    public function update()
    {
        $medication = Medication::find($this->idEditable);
        $medication->update([
            'name' => $this->Edit['name'],
            'description' => $this->Edit['description'],
            'dosage' => $this->Edit['dosage'],
        ]);

        $this->reset(['Edit', 'idEditable', 'modalE']);
    }
}
