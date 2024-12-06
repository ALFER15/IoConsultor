<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assignment;
use App\Models\Patient;
use App\Models\Medication;
use App\Models\Diagnose;
use App\Models\Doctor;

class LiveA extends Component
{
    use WithPagination;

    public $patient_id, $medication_id, $diagnose_id, $doctor_id, $date;
    public $modalC = false; // Modal para crear
    public $modalE = false; // Modal para editar
    public $idEditable;
    public $Edit = [
        'id' => '',
        'patient_id' => '',
        'medication_id' => '',
        'diagnose_id' => '',
        'doctor_id' => '',
        'date' => '',
    ];
    public $search = '';

    public function render()
    {
        $assignments = Assignment::with(['patient', 'medication', 'diagnose', 'doctor'])
            ->whereHas('patient', fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->paginate(5);

        return view('livewire.live-a', [
            'assignments' => $assignments,
            'patients' => Patient::all(),
            'medications' => Medication::all(),
            'diagnoses' => Diagnose::all(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function save()
    {
        $this->validate([
            'patient_id' => 'required|exists:patients,id',
            'medication_id' => 'required|exists:medications,id',
            'diagnose_id' => 'required|exists:diagnoses,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);

        Assignment::create([
            'patient_id' => $this->patient_id,
            'medication_id' => $this->medication_id,
            'diagnose_id' => $this->diagnose_id,
            'doctor_id' => $this->doctor_id,
            'date' => $this->date,
        ]);

        $this->reset(['patient_id', 'medication_id', 'diagnose_id', 'doctor_id', 'date']);
        $this->modalC = false;
    }

    public function edit($id)
    {
        $this->modalE = true;
        $assignment = Assignment::findOrFail($id);

        $this->idEditable = $assignment->id;
        $this->Edit['patient_id'] = $assignment->patient_id;
        $this->Edit['medication_id'] = $assignment->medication_id;
        $this->Edit['diagnose_id'] = $assignment->diagnose_id;
        $this->Edit['doctor_id'] = $assignment->doctor_id;
        $this->Edit['date'] = $assignment->date;
    }

    public function update()
    {
        $this->validate([
            'Edit.patient_id' => 'required|exists:patients,id',
            'Edit.medication_id' => 'required|exists:medications,id',
            'Edit.diagnose_id' => 'required|exists:diagnoses,id',
            'Edit.doctor_id' => 'required|exists:doctors,id',
            'Edit.date' => 'required|date',
        ]);

        $assignment = Assignment::findOrFail($this->idEditable);

        $assignment->update([
            'patient_id' => $this->Edit['patient_id'],
            'medication_id' => $this->Edit['medication_id'],
            'diagnose_id' => $this->Edit['diagnose_id'],
            'doctor_id' => $this->Edit['doctor_id'],
            'date' => $this->Edit['date'],
        ]);

        $this->reset(['Edit', 'idEditable', 'modalE']);
    }

    public function delete($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'search') {
            $this->resetPage();
        }
    }
}
