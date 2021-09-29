<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $_fillable = [
        'employee_name',
        'employee_contact',
        'employee_address',
        'employee_email',
        'employee_id_type',
        'employee_id_no',
        'employee_position',
       ];
       public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
