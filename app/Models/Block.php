<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = 'blocks';

    protected $fillable = [
        'building_id', 
        'block_name',  
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'block_id'); 
    }
}
