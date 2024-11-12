<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'room_id',
        'bedno',
        'total_charge',
        'fullname',
        'duration_months',
        'emergency_contact_name',
        'emergency_contact_phone',
        'date_of_birth',
        'gender',
        'year_of_study',
        'department',
        'rollno',
        'status',
        'booking_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            // Set the booking_date to the current date if not provided
            if (empty($booking->booking_date)) {
                $booking->booking_date = Carbon::now()->toDateString(); // Set to current date
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class, 'bedno', 'bed_no');
    }
}