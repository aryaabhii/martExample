<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantService extends Model
{
    use HasFactory;

    protected $table = 'merchant_services';

    protected $fillable = [
        'merchant_id',
        'image',
        'title',
        'description'
    ];

    public function getImageAttribute($value){
        return asset('/uploads/merchant/service/'.$value);
    }    
}