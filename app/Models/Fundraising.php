<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Fundraising extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'image',
        'target_amount',
        'collected_amount',
        'end_date',
        'organization_name',
        'phone',
        'status',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($fund) {
            $fund->slug = Str::slug($fund->title) . '-' . Str::random(5);
        });
    }
}
