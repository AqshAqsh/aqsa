<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table='members';

    protected $fillable=[
    'name',
    'email',
    'password',
    'username',
    'dob',
    'religion',
    'gender',
    'address',
    'guardian_number',
    'guardian_name',
    'guardian_relation',
    'image',

    ];


}
