<?php

namespace App\Models\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'app_doc_id',
        'app_doc_name',
    ];

    // Define the relationship
    public function patient()
    {
        return $this->belongsTo(PatientRecord::class);
    }
}
