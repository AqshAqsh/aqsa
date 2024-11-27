<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = 'blocks';

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
    public function rooms()
    {
        return $this->hasMany(Room::class, 'block_id'); // 'block_id' should be the foreign key in the 'rooms' table
    }
}
