<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;

    public $sub_category_id;
    public $sub_category_slug;

    public function mount($category_slug, $sub_category_slug = null)
    {
        if($sub_category_slug){
            $this->sub_category_slug = $sub_category_slug;
            $sub_category = Subcategory::where('slug', $sub_category_slug)->first();
            $this->sub_category_id = $sub_category->id;
            $this->category_id = $sub_category->category_id;
            $this->name = $sub_category->name;
            $this->slug = $sub_category->slug;
        } else {
            $this->category_slug = $category_slug;
            $category = Category::where('slug', $category_slug)->first();
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
         }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
    }

    public function editCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        if($this->sub_category_id) {
            $sub_category = Subcategory::find($this->sub_category_id);
            $sub_category->name = $this->name;
            $sub_category->slug = $this->slug;
            $sub_category->category_id = $this->category_id;
            $sub_category->save();
        } else {
            $category = Category::find($this->category_id);
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }
        session()->flash('message', 'Category edited successfully!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-category-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
