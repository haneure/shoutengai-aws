<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class CategoryComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $category_slug;

    public $sub_category_slug;

    public $min_price;
    public $max_price;

    public function mount($category_slug, $sub_category_slug=null)
    {
        $this->sorting = 'default';
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
        $this->$sub_category_slug = $sub_category_slug;

        $this->min_price = 1;
        $this->max_price = 10000;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success', 'Product added to cart ');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price){
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('addWishlist', 'Product added to wishlist');
        $this->emitTo('wishlist-count-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $wishlist){
            if($wishlist->id == $product_id){
                Cart::instance('wishlist')->remove($wishlist->rowId);
                session()->flash('removeWishlist', 'Product removed from wishlist');
                $this->emitTo('wishlist-count-component', 'refreshComponent');
                return;
            }
        }
    }

    public function render()
    {
        $category_id = null;
        $category_name = "";
        $filter = "";

        if($this->sub_category_slug) {
            $sub_category_slug = Subcategory::where('slug', $this->sub_category_slug)->first();
            $category_id = $sub_category_slug->id;
            $category_name = $sub_category_slug->name;
            $filter = "sub";
        } else {
            $category = Category::where('slug', $this->category_slug)->first();
            $category_id = $category->id;
            $category_name = $category->name;
            $filter = "";
        }

        if($this->sorting == 'date'){
            $products = Product::where($filter.'category_id', $category_id)->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } else if($this->sorting == 'price'){
            $products = Product::where($filter.'category_id', $category_id)->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } else if($this->sorting == 'price-desc'){
            $products = Product::where($filter.'category_id', $category_id)->whereBetween('regular_price', [$this->min_price, $this->max_price])->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else {
            $products = Product::where($filter.'category_id', $category_id)->whereBetween('regular_price', [$this->min_price, $this->max_price])->paginate($this->pagesize);
        }

        $categories = Category::all();

        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.category-component', [ 'products' => $products, 'categories'=>$categories, 'category_name'=>$category_name])->layout("layouts.base");
    }
}
