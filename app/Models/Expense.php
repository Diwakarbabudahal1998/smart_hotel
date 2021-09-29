<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
 use HasFactory;
 protected $_fillable = [
  'user_id',
  'expense_name',
  'expense_description',
  'expense_amount',
  'expense_type',
 ];
 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }
}