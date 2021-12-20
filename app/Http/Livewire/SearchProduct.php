<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;
class SearchProduct extends Component
{
    public function store($product_id, $product_name, $product_color, $product_price)
    {
        if(ProductDetail::find($product_id))
        {
        Cart::add($product_id, $product_name, 1, $product_price);
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
        }
        else{
            dd('false');
        }
    }
    use WithPagination;
    // public $products;
    // public $collectionProduct;
    public $key;
    public $colorId=null;
    public $selectionCatid=null;
    public $minPrice;
    public $maxPrice;
    public $sortFeature = 'cert_products.id';
    public $sortOrder = 'asc';
    public $viewForm = 'grid';
    protected $listeners = ['changeSort' => 'changeSortFeature', 'publishSort','store','orderChange','ChangeviewFormat','updateSelection'];

    public function mount() {
        $this->emit('publishSort' ,$this->sortFeature);
        $this->minPrice=intval(Product::min('sale') <= Product::min('price') ? Product::min('sale') : Product::min('price') );
        $this->maxPrice=intval(Product::max('sale'));
    }
    public function updateSelection($catid, $minPrice, $maxPrice,$colorId){
        // dd($catid);
        $this->selectionCatid=$catid;
        $this->minPrice=$minPrice;
        $this->maxPrice=$maxPrice;
        $this->colorId = $colorId;
        $this->resetPage();
    }
    public function changeSortFeature($value) {
        $this->sortFeature = $value;
        $this->resetPage();
    }
    public function orderChange($value) {
        $this->sortOrder = $value;
        $this->resetPage();
    }
    public function publishSort($value) {
        $this->sortFeature = $value;
        $this->resetPage();
    }
    public function ChangeviewFormat($value)
    {
        $this->viewForm = $value;
        $this->resetPage();
    }


    public function render()
    {
        if($this->selectionCatid == null){
            if($this->colorId == null)
            {
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('brands', 'models.brand_id', '=', 'brands.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->where('models.name' ,'LIKE','%'.$this->key.'%')->orWhere('categories.name' ,'LIKE','%'.$this->key.'%')->orWhere('products.name' ,'LIKE','%'.$this->key.'%')->orWhere('brands.name' ,'LIKE','%'.$this->key.'%')->select('cert_products.*','products.sale','categories.id AS category')->get();
                $products = $rawProducts->where('sale','>=', $this->minPrice)->where('sale','<=', $this->maxPrice);
                $temp = $products->count();
            }
            else{
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('brands', 'models.brand_id', '=', 'brands.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->where('models.name' ,'LIKE','%'.$this->key.'%')->orWhere('categories.name' ,'LIKE','%'.$this->key.'%')->orWhere('products.name' ,'LIKE','%'.$this->key.'%')->orWhere('brands.name' ,'LIKE','%'.$this->key.'%')->select('cert_products.*','products.sale','categories.id AS category')->get();
                $products = $rawProducts->where('sale','>=', $this->minPrice)->where('sale','<=', $this->maxPrice)->where('color_id', '=' , $this->colorId);
                $temp = $products->count();
            }
        }
        else{
            if($this->colorId == null)
            {
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('brands', 'models.brand_id', '=', 'brands.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->where('models.name' ,'LIKE','%'.$this->key.'%')->orWhere('categories.name' ,'LIKE','%'.$this->key.'%')->orWhere('products.name' ,'LIKE','%'.$this->key.'%')->orWhere('brands.name' ,'LIKE','%'.$this->key.'%')->select('cert_products.*','products.sale','categories.id AS category')->get();
                $products = $rawProducts->where('sale','>=', $this->minPrice)->where('sale','<=', $this->maxPrice)->where('category', $this->selectionCatid);
                $temp = $products->count();
            }
            else{
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('brands', 'models.brand_id', '=', 'brands.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->where('models.name' ,'LIKE','%'.$this->key.'%')->orWhere('categories.name' ,'LIKE','%'.$this->key.'%')->orWhere('products.name' ,'LIKE','%'.$this->key.'%')->orWhere('brands.name' ,'LIKE','%'.$this->key.'%')->select('cert_products.*','products.sale','categories.id AS category')->get();
                $products = $rawProducts->where('sale','>=', $this->minPrice)
                ->where('sale','<=', $this->maxPrice)->where('category', $this->selectionCatid)->where('cert_products.color_id', '=' , $this->colorId);
                $temp = $products->count();
            }
        }
        // dd($products);
        // dd($this->products);
        $this->emit('productCountUpdate', $temp);
        return view('livewire.search-product',[
            'products' => $products,
        ]);
    }
}
