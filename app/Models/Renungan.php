<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getStatusPublikasiAttribute($value)
    {
        if ($value == 'Jadwalkan' && $this->published_at <= now()) {
            // Ubah status menjadi 'Published' jika waktunya telah tiba
            return 'Sekarang';
        }
        return $value;
    }
}
