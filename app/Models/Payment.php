<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'bukti_transfer',
        'nominal',
        'status',
        'catatan_admin',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
