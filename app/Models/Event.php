<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'event_date',
        'location',
        'category',
        'organizer',
        'quota',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            $event->slug = Str::slug($event->title) . '-' . Str::random(5);
        });
    }
}
