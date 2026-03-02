<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'hero_description',
        'image',
        'vision',
        'mission_1',
        'mission_2',
        'mission_3',
        'founded_year',
        'cta_title',
        'cta_description',
        'cta_primary_button',
        'cta_secondary_button',
    ];
}
