<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use App\Models\Product;
class ProductDetailSection extends Component
{
    public $product;
    public $images;
    public function render()
    {
        $productId = $this->product->product->id;
        $modelId = $this->product->product->model->id;
        $categoryId = $this->product->product->model->category->id;
        // $products = Product::join('cert_products', 'cert_products.product_id',
        //                     '=','products.id')->where('products.model_id',
        //                     $modelId)->select('products.*')->paginate(100)
        $products = Product::where('model_id', $modelId)->get();
        $colors =  ProductDetail::join('colors', 'cert_products.color_id',
        '=','colors.id')->where('cert_products.product_id',
        $productId)->select('colors.*')->get();
        $relatedProducts = Product::join('models', 'products.model_id',
        '=','models.id')->where('models.category_id', $categoryId)->select('products.*')->get();
        
        $productDetails = ProductDetail::all();
        return view('livewire.product-detail-section',[
            'products' => $products,
            'colors' => $colors,
            'productId' => $productId,
            'productDetails' => $productDetails,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
