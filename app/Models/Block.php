<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'building_id', // Foreign key to buildings
        'block_name',  // Block name
    ];

    // Define relationships if needed
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}