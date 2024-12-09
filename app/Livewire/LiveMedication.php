<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Medication;

class LiveMedication extends Component
{
    use WithPagination;

    public $name, $description, $modalC = false, $modalE = false;
    public $idEditable;
    public $Edit = [
        'id' => '',
        'name' => '',
        'description' => '',
    ];
    public $search = '';

    public function render()
    {
        $medications = Medication::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(5);

        return view('livewire.live-medication', [
            'medications' => $medications,
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Medication::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'description', 'modalC']);
    }

    public function edit($id)
    {
        $this->modalE = true;
        $medication = Medication::findOrFail($id);

        $this->idEditable = $medication->id;
        $this->Edit['name'] = $medication->name;
        $this->Edit['description'] = $medication->description;
    }

    public function update()
    {
        $this->validate([
            'Edit.name' => 'required|string|max:255',
            'Edit.description' => 'nullable|string|max:1000',
        ]);

        $medication = Medication::findOrFail($this->idEditable);

        $medication->update([
            'name' => $this->Edit['name'],
            'description' => $this->Edit['description'],
        ]);

        $this->reset(['Edit', 'idEditable', 'modalE']);
    }

    public function delete($id)
    {
        $medication = Medication::findOrFail($id);
        $medication->delete();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'search') {
            $this->resetPage();
        }
    }
}
