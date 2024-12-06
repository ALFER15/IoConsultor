<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medication_id',
        'diagnose_id',
        'doctor_id',
        'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);

    }

    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);

    }
}
