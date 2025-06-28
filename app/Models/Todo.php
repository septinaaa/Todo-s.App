<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
    'name',
    'description',
    'status',
    'deadline',
    'user_id',
    'location_name',
    'latitude',
    'longitude',
];

}
