<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'tanggal',
        'waktu',
        'lokasi',
        'kuota',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'tanggal'   => 'date',
        'is_active' => 'boolean',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function sisaKuota(): int
    {
        return $this->kuota - $this->registrations()->whereIn('status', ['pending', 'diterima'])->count();
    }
}
