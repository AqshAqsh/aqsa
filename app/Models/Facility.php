<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $table = 'facilities';

    protected $fillable = [
        'room_id',
        'name',
        'description',
        'icon',
    ];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
