<?php

namespace App\Models\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTestRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_test_id',
        'test_category',
        'test_name',
        'test_cost',
        'total_cost',
        'test_delivery_date',
        'test_status'
    ];

    protected $dates = [
        'test_delivery_date',
    ];

    // Define the relationship
    /*public function patient()
    {
        return $this->belongsTo(PatientRecord::class);
    }*/

    // Define the relationship
    public function test()
    {
        return $this->belongsTo(PatientTest::class);
    }

}
