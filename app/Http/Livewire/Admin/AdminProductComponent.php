<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if($product->image)
        {
            if(strpos($product->image, 'http') !== false){
                $image = explode('/', $product->image);
                $image = end($image);
                Storage::disk('s3')->delete('products/'.$image);
                //Storage::disk('s3')->delete($product->image);
            } else {
                unlink('assets/images/products'.'/'.$product->image);
            }
        }
        if($product->images)
        {
            $images = explode(',', $product->images);
            foreach($images as $image)
            {
                if($image){
                    if(strpos($image, 'http') !== false){
                        $image_format = explode('/', $image);
                        $image_format = end($image_format);
                        Storage::disk('s3')->delete('products/'.$image_format);
                    } else {
                        unlink('assets/images/products'.'/'.$image);
                    }
                }
            }
        }
        $product->delete();
        session()->flash('message', 'Product has been deleted successfully!');
    }

    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $products = Product::where('name', 'LIKE', $search)
        ->orWhere('stock_status', 'LIKE', $search)
        ->orWhere('regular_price', 'LIKE', $search)
        ->orWhere('sale_price', 'LIKE', $search)
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('livewire.admin.admin-product-component', ['products'=>$products])->layout('layouts.base');
    }
}
