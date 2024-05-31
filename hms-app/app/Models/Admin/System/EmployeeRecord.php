<?php

namespace App\Models\Admin\System;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class EmployeeRecord extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'department',
        'salary',
        'hire_date',
        'designation',
        'employment_type',
        'gender',
        'birth_date',
        'address',
        'nid',
        'phone',
        'email',
        'password',
    ];

    protected $dates = [
        'hire_date',
        'birth_date',
    ];
}
