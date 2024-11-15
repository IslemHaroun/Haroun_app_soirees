<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'location',
        'type',
        'date_time',
        'remaining_seats',
        'is_paid',
        'price'
    ];

    // Relation avec l'utilisateur (organisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
