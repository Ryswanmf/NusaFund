<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_description',
        'meta_keywords',
        'category',
        'target_amount',
        'collected_amount',
        'image',
        'end_date',
        'is_urgent',
        'status'
    ];

    protected $casts = [
        'end_date' => 'date',
        'is_urgent' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($campaign) {
            $campaign->slug = Str::slug($campaign->title) . '-' . Str::random(5);
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function updates()
    {
        return $this->hasMany(CampaignUpdate::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
