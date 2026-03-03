<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Zakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'institution',
        'collected_amount',
        'asnaf_category',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($zakat) {
            $zakat->slug = \Illuminate\Support\Str::slug($zakat->title) . '-' . \Illuminate\Support\Str::random(5);
        });
    }

    public function payments()
    {
        return $this->hasMany(ZakatPayment::class);
    }
}
