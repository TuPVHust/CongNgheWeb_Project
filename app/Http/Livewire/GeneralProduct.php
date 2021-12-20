<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductDetail;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;
class GeneralProduct extends Component
{

    // store to cart
    public function store($product_id, $product_name, $product_color, $product_price)
    {
        if(ProductDetail::find($product_id))
        {
        Cart::add($product_id, $product_name, 1, $product_price);
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
        }
    }

    use WithPagination;
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
        $this->selectionCatid=$catid;
        $this->minPrice=$minPrice;
        $this->maxPrice=$maxPrice;
        $this->colorId = $colorId;
        $this->resetPage();
    }

    public function changeSortFeature($value) {
        $this->sortFeature = $value;
    }
    public function orderChange($value) {
        $this->sortOrder = $value;
    }
    public function publishSort($value) {
        $this->sortFeature = $value;
    }
    public function ChangeviewFormat($value)
    {
        $this->viewForm = $value;
    }
    public function render()
    {
        if($this->selectionCatid == null){
            if($this->colorId == null)
            {
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->select('cert_products.*')->where('sale','>=', $this->minPrice)
                ->where('sale','<=', $this->maxPrice);
                $products = $rawProducts->paginate(6);
                $temp = $products->total();
            }
            else{
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->select('cert_products.*')->where('sale','>=', $this->minPrice)
                ->where('sale','<=', $this->maxPrice)->where('cert_products.color_id', '=' , $this->colorId);
                $products = $rawProducts->paginate(6);
                $temp = $products->total();
            }
        }
        else{
            if($this->colorId == null)
            {
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->select('cert_products.*')->where('sale','>=', $this->minPrice)
                ->where('sale','<=', $this->maxPrice)->where('categories.id', $this->selectionCatid);
                $products = $rawProducts->paginate(6);
                $temp = $products->total();
            }
            else{
                $rawProducts = ProductDetail::join('products', 'cert_products.product_id', '=', 'products.id')->join('models', 'products.model_id', '=', 'models.id')->join('categories', 'models.category_id', '=', 'categories.id')->orderBy($this->sortFeature, $this->sortOrder)->select('cert_products.*')->where('sale','>=', $this->minPrice)
                ->where('sale','<=', $this->maxPrice)->where('categories.id', $this->selectionCatid)->where('cert_products.color_id', '=' , $this->colorId);
                $products = $rawProducts->paginate(6);
                $temp = $products->total();
            }
        }
        $this->emit('productCountUpdate', $temp);
        return view('livewire.general-product',[
            'products' => $products,
        ]);
    }
}
