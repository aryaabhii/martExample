<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = [
        'user_id',
        'amount',
        'fullName',
        'phone',
        'email',
        'address',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'tracking_no',
        'card_number',
    ];
}