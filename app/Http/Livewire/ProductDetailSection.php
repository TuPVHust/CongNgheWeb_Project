<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use App\Models\Product;
use Cart;
class ProductDetailSection extends Component
{
    public function store($product_id, $product_name, $product_color, $product_price,$quantity)
    {
        // if($product_color == 'none'){
        //     Cart::add($product_id, $product_name, 1, $product_price);
        // }
        // else{
        //     $product_name = $product_name . ' ' . $product_color;
        //     Cart::add($product_id, $product_name, 1, $product_price);
        // }
        Cart::add($product_id, $product_name, $quantity, $product_price);
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }
    protected $listeners = ['store'];
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
