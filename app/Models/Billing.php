<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'user_name',
        'email',
        'address',
        'contact',
        'subscription_type',
        'subscriptions_days',
        'price',
       ];
       public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}