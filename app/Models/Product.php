<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;
    protected $table='products';
    protected $primaryKey = 'id';
    protected $fillable=['name', 'model_id', 'description','price', 'sale'];


    public function model()
    {
        return $this->belongsTo(proModel::class,'model_id');
    }
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
