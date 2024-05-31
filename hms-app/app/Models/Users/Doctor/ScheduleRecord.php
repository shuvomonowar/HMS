<?php

namespace App\Models\Users\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'schedule_day',
        'start_time',
        'end_time',
    ];

    // Relationship with DoctorRecord model
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(DoctorRecord::class);
    }
}
