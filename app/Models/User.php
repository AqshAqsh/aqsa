<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    use Notifiable;
    use HasFactory;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';  // Set the primary key to 'user_id'

    /**
     * Indicates if the ID is auto-incrementing.
     *
     * @var bool
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false;
    protected $keyType = 'string';  
    protected $fillable = [
        'name',
        'email',
        'user_id',
        'role',
        'full_name',           
        'gender',              
        'date_of_birth',
        'contact_number',
        'permanent_address',
        'current_address',
        'college_roll_number',
        'college_department',
        'semester',
        'program',
        'enrollment_year',
        'room_number',
        'hostel_block',
        'bed_number',
        'guardian_name',
        'guardian_contact_number',
        'guardian_address',
        'relation_to_guardian',
        'user_picture',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'user_id');
    }
    // In User model
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id', 'user_id');
    }
    public function notifications()
    {
        return $this->morphMany(\Illuminate\Notifications\DatabaseNotification::class, 'notifiable');
    }
    public function beds()
    {
        return $this->hasone(Bed::class);
    }
}
