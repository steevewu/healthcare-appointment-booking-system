<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'start_at',
        'end_at',
        'description'
    ];




    public function workshifts(): HasMany{
        return $this->hasMany(Workshift::class, 'event_id', 'id');
    }


    public function appointments(): HasManyThrough{
        return $this->hasManyThrough(Appointment::class, Workshift::class, 'event_id', 'workshift_id', 'id', 'id');
    }
}
