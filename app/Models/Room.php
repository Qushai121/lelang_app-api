<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    // public $fillable = [
    //     "room_name", "room_description", "room_avatar"
    // ];

    public $timestamps = true;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messagges() : BelongsToMany
    {
        return $this->belongsToMany(Message::class);
    }
}
