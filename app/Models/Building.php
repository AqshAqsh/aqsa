<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'name', // Building name
    ];

    // Define relationships if needed
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}