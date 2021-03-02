<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'dob',
        'class_id',
        'gender',
        'father',
        'mother',
        'guardian',
        'street',
        'state_id',
        'city_id',
        'fmobile',
        'gmobile',
        'email'

    ];
}
