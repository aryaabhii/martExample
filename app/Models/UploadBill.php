<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadBill extends Model
{
    use HasFactory;

    protected $table = 'upload_bills';

    protected $fillable = [
        'user_id',
        'billPic'
    ];  

    public function getImageAttribute($value){
        return asset('/uploads/user/bill/'.$value);
    }
}