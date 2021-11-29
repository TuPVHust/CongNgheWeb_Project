<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proModel extends Model
{
    use HasFactory;
    protected $table='models';
    protected $primaryKey = 'id';
    protected $fillable=['name', 'category_id', 'brand_id'];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class,'model_id');
    }
}

