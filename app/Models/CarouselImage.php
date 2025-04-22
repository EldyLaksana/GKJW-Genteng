<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kabarJemaat()
    {
        return $this->belongsTo(KabarJemaat::class);
    }
}
