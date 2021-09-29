<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 use HasFactory;
 protected $_fillable = [
  'user_id',
  'table_id',
  'status',
  'payment_status',
  'total_discount',
  'total_tax',
  'total_price',
 ];
 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }
 public function menus()
 {
  return $this->hasMany(OrderMenu::class);
 }
 public function table()
 {
  return $this->belongsTo(Table::class, 'table_id');
 }
}