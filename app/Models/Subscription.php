<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $_fillable = [
        'title',
        'description',
        'price',
        'secondary_title',
        'subscription_type',
        'subscriptions_days',
       ];
       public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
