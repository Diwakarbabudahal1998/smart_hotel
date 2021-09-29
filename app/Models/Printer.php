<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;
    protected $fillable=[
        'bill_header',
        'bill_footer',
        'printer_size',
        'status',
        
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
