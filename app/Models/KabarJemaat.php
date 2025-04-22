<?php

namespace App\Models;

use App\Models\CarouselImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KabarJemaat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function carouselImages()
    {
        return $this->hasMany(CarouselImage::class);
    }




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
