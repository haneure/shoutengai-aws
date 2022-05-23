<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $images;

    public $sub_category_id;

    public function mount()
    {
        $this->stock_status = 'in_stock';
        $this->featured = 0;
        $this->sale_price = null;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png',
            'category_id' => 'required'
        ]);
    }

    public function addProduct() {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png',
            'category_id' => 'required'
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $path = $this->image->storeAs('products', $imageName, 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        //Store image with s3 full url
        //$product->image = $imageName;
        $product->image = Storage::disk('s3')->url($path);

        // return $product;

        if($this->images)
        {
            $imagesname = '';
            foreach($this->images as $key=>$image)
            {
                // $imgName = Carbon::now()->timestamp. $key . '.' . $image->extension();
                // $image->storeAs('products', $imgName);
                // $imagesname = $imagesname.','.$imgName;

                //Upload to AWS
                $imgName = Carbon::now()->timestamp. $key . '.' . $image->extension();
                $path = $image->storeAs('products', $imgName, 's3');
                Storage::disk('s3')->setVisibility($path, 'public');
                $imagesname = $imagesname.','.Storage::disk('s3')->url($path);
            }
            $product->images = $imagesname;
        }

        $product->category_id = $this->category_id;
        if($this->sub_category_id){
            $product->subcategory_id = $this->sub_category_id;
        }

        $product->save();
        session()->flash('message', 'Product has ben added successfully');
    }

    public function changeSubcategory() {
        $this->sub_category_id = 0;
    }

    public function render()
    {
        $categories = Category::all();
        $sub_categories = Subcategory::where('category_id', $this->category_id)->get();
        return view('livewire.admin.admin-add-product-component', ['categories'=>$categories, 'sub_categories'=>$sub_categories])->layout('layouts.base');
    }
}
