<?php

namespace App\Models\Users\Doctor;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

class DoctorRecord extends AuthenticatableUser implements Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'specialization',
        'qualification',
        'phone_number',
        'email',
        'password',
    ];

    // Relationship with Schedule model
    public function schedules(): HasMany
    {
        return $this->hasMany(ScheduleRecord::class);
    }
}
