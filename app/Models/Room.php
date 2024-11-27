<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_no',
        'room_category_id',
        'description',
        'room_charge',
        'block_id',  
        'number_of_members',
        'picture',

    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    // Relationship to RoomCategory
    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    // Relationship to Bed
    public function beds()
    {
        return $this->hasMany(Bed::class, 'room_id');
        
    }
    // Relationship to Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_no');
    }

    // Relationship to Facility
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_room');
    }
}