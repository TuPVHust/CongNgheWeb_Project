<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductDetail;
use App\Models\Category;
use Cart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search( Request $request){
        if(!request()->filled('key')){
            return redirect()->route('shop');
        }
        else
        {
        $key = $_GET['key'];
        $products = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('brands', 'models.brand_id', '=', 'brands.id')->join('categories', 'models.category_id', '=', 'categories.id')->where('models.name' ,'LIKE','%'.$key.'%')->orWhere('categories.name' ,'LIKE','%'.$key.'%')->orWhere('products.name' ,'LIKE','%'.$key.'%')->orWhere('brands.name' ,'LIKE','%'.$key.'%')->get('cert_products.*');
        // $products = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('categories', 'models.category_id', '=', 'categories.id')->get('cert_products.*');
        // dd($products);
        return view('site.search',[
            'products' => $products,
            'key' => $key,
        ]);
        }  
    }
    public function getCheckOut(){
        $items=Cart::content();
        return view('site.checkout',[
            'items' => $items,
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = ProductDetail::paginate(8);
        $latestProducts = ProductDetail::orderby('created_at','desc')->take(3)->get();
        $categories = Category::all();
        return view('site.home',[
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
        ]);
    }
}
