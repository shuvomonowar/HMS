<?php

namespace App\Models\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'blood_group',
        'birth_date',
        'age',
        'address',
        'phone_number',
        'email',
    ];

    protected $dates = [
        'birth_date',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(AppointmentRecord::class);
    }

    public function patientTests(): HasMany
    {
        return $this->hasMany(PatientTest::class);
    }
}
