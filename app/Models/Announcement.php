<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'admin_id',
        'judul',
        'isi',
        'tanggal_publish',
        'is_active',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'is_active'       => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
