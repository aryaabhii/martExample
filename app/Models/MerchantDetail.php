<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantDetail extends Model
{
    use HasFactory;

    protected $table = 'merchant_details';

    protected $fillable = [
        'merchant_id',
        'image',
        'about',
        'company',
        'address',
        'twitter',
        'facebook',
        'linkedin',
        'instagram',
    ];

    public function getImageAttribute($value){
        return asset('/uploads/merchant/profile/'.$value);
    } 

    // public function getServiceImage($value){
    //     return asset('/uploads/merchant/service/'.$value);
    // } 
}