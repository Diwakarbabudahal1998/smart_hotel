<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;
    protected $fillable=[
        'extra_name',
        'extra_price',
       
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
