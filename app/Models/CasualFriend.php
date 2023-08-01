<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasualFriend extends Model
{
    use HasFactory;

    protected $table = 'casual_friends';
    protected $fillable = ['name', 'photo', 'hobby'];

    public function scopeGetByHobby($query, $hobby)
    {
        return $query->where('hobby', $hobby);
    }
}
