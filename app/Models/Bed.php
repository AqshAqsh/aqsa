<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $table = 'beds';

    protected $fillable = [
        'bed_no',
        'room_id',
        'description',
        'is_occupied',
        'user_id',
        'status',
    ];

    // Relationship to Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Check if the bed is available
    public function isAvailable()
    {
        return !$this->is_occupied; // Returns true if the bed is not occupied
    }

    // Mark the bed as occupied
    public function markAsOccupied()
    {
        $this->update(['is_occupied' => true]);
    }

    // Mark the bed as available
    public function markAsAvailable()
    {
        $this->update(['is_occupied' => false]);
    }
    // In Bed Model
    public function booking()
    {
        return $this->hasOne(Booking::class); // Adjust according to your relationship
    }
}
