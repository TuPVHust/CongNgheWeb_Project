<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='order_details';
    protected $primaryKey = 'id';
    protected $fillable=['order_id', 'cert_product_id', 'quantity'];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'cert_product_id');
    }
}
