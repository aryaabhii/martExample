<?php

namespace App\Models;
use App\Models\ShopImage;
use App\Models\MerchantDetail;
use App\Models\MerchantService;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'merchant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function merchantDetail(){
        return $this->hasOne(MerchantDetail::class, 'merchant_id', 'id');
    }

    public function shopImages(){
        return $this->hasMany(ShopImage::class, 'merchant_id','id');
    }
}