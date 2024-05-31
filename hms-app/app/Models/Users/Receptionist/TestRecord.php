<?php

namespace App\Models\Users\Receptionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'test_category',
        'test_cost',
    ];
}
