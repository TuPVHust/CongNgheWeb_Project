<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table='cert_products';
    protected $primaryKey = 'id';
    protected $fillable=['product_id', 'color_id', 'images','inventary','status','poster'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
