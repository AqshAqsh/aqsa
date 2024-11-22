<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Notices extends Model
{
    use HasFactory;

    protected $table = 'notices';

    protected $fillable = [
        'title',
        'date',
        'content',
        'expiry_date',
    ];
    protected $casts = [
        'expiry_date' => 'datetime',  // Ensures expiry_date is a Carbon instance
    ];

    public function scopeActive($query)
    {
        return $query->where('expiry_date', '>=', now());
    }
}
