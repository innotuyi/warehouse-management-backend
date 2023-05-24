<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'Order_tbl';

    public $fillable = ['customer_id', 'product_id', 'quantity', 'price'];

}
