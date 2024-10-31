<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kategori'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kabarJemaats()
    {
        return $this->hasMany(KabarJemaat::class);
    }
}
