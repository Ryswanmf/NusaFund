<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'whatsapp',
        'email',
        'address',
        'copyright',
        'site_logo',
        'impact_image',
    ];
}
