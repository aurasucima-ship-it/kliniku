<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'pendaftaran_id', 
        'title', 
        'message', 
        'is_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function pasien()
    {
        return $this->hasOneThrough(
            Pasien::class,
            Pendaftaran::class,
            'id',
            'id',
            'pendaftaran_id',
            'pasien_id'
        );
    }
}
