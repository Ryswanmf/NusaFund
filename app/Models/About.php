<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'hero_description',
        'vision',
        'mission_1',
        'mission_2',
        'mission_3',
        'founded_year',
        'cta_title',
        'cta_description',
        'cta_primary_button',
        'cta_secondary_button'
    ];
}
