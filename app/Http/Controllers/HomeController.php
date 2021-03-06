<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductDetail;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Cart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function search( Request $request){
        if(!request()->filled('key')){
            return redirect()->route('shop');
        }
        else
        {
        // $request->flashOnly(['key']);
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
    public function placeOrder(Request $request ){
        // dd('oki');
        if(Auth::check())
        {
            if($request->validate([
                // 'name'=>'required|unique:products,name',
                // 'model'=>'required',
                // 'description'=>'required',
                // 'price' => 'required|numeric|min:0',
                // 'sale' => 'required|numeric|min:0'
                'name'=>'required',
                'address' => 'required',
                'phone' => 'required|max:11|min:9',
                'email' => 'required|email',
            ],
            [
                'name.required' => 'C???n nh???p t??n ng?????i nh???n',
                'address.required' => 'c???n nh???p ?????a ch??? nh???n',
                'phone.required' => 'c???n nh???p s??? ??i???n tho???i',
                'email.required' => 'c???n nh???p email',
                'email.email' => 'email kh??ng h???p l???',
                'phone.min' => 's??? ??i???n tho???i qu?? ng???n',
                'phone.max' => 's??? ??i???n tho???i qu?? d??i',
            ])){
                // dd(Auth::user()->id);
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'note' => $request->input('note'),
                ]);
               if(Cart::count() > 0)
               {
                   $items = Cart::content();
                   foreach( $items as $item)
                   {
                       $orderDetail = OrderDetail::create([
                           'order_id' => $order->id,
                           'cert_product_id' => $item->id,
                           'quantity' => $item->qty,
                       ]);
                   }  
                   Cart::destroy();
                   return redirect()->route('shop')->with('success','?????t h??ng th??nh c??ng.');
               }
               else{
                    return redirect()->route('shop')->with('danger','r??? h??ng kh??ng t???n t???i.');
               }
            }
        }
        else{
            return redirect()->action(route('login'));
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = ProductDetail::orderby('id','desc')->get();
        $latestProducts = ProductDetail::orderby('created_at','desc')->take(3)->get();
        $categories = Category::all();
        return view('site.home',[
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
        ]);
    }
}
