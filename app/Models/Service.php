<?php

namespace App\Models;

use App\Models\Merchant;
use App\Models\MerchantDetail;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, Sluggable;
    
    protected $fillable = [
        'image',
        'title',
        'description',
    ];

    public function sluggable(): array{
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function merchants(){
        return $this->hasMany(Merchant::class, 'id')->with('merchantDetail');
    }
}