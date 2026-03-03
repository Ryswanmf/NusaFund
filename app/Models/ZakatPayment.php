<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZakatPayment extends Model
{
    protected $fillable = [
        'zakat_id',
        'user_id',
        'transaction_id',
        'amount',
        'payer_name',
        'payer_email',
        'phone',
        'status'
    ];

    public function zakat()
    {
        return $this->belongsTo(Zakat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
