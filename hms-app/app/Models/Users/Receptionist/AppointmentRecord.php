<?php

namespace App\Models\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'doctor_id',
        'doctor_name',
        'appointment_date',
        'appointment_day',
        'appointment_time',
        'appointment_serial',
        'reason',
        'status',
    ];

    protected $dates = [
        'appointment_date',
    ];

    // Define the relationship
    public function patient()
    {
        return $this->belongsTo(PatientRecord::class);
    }
}
