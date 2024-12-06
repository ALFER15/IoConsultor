<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Diagnose;

class LiveDiagnose extends Component
{
    use WithPagination;

    public $description, $name;
    public $modalC = false;
    public $modalE = false;
    public $idEditable;
    public $Edit = [
        'id' => '',
        'description' => '',
        'name' => '',
    ];
    public $search = '';

    public function render()
    {
        $diagnoses = Diagnose::where('description', 'like', '%' . $this->search . '%')
                             ->orWhere('name', 'like', '%' . $this->search . '%')
                             ->paginate(5);

        return view('livewire.live-diagnose', [
            'diagnoses' => $diagnoses
        ]);
    }

    public function save()
    {
        $this->validate([
            'description' => 'required|string|max:255',
            'name' => 'required',
        ]);

        Diagnose::create([
            'description' => $this->description,
            'name' => $this->name,
        ]);

        $this->reset(['description', 'name']);
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
        $diagnose = Diagnose::find($id);
        $diagnose->delete();
    }

    public function edit($id)
    {
        $this->modalE = true;
        $diagnose = Diagnose::find($id);
        $this->idEditable = $diagnose->id;
        $this->Edit['id'] = $diagnose->id;
        $this->Edit['description'] = $diagnose->description;
        $this->Edit['name'] = $diagnose->name;
    }

    public function update()
    {
        $this->validate([
            'Edit.description' => 'required|string|max:255',
            'Edit.name' => 'required',
        ]);

        $diagnose = Diagnose::find($this->idEditable);
        $diagnose->update([
            'description' => $this->Edit['description'],
            'name' => $this->Edit['name'],
        ]);

        $this->reset(['Edit', 'idEditable', 'modalE']);
    }
}
