<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category has been deleted successfully!');
    }

    public function deleteSubCategory($id)
    {
        $subCategory = Subcategory::find($id);
        $subCategory->delete();
        session()->flash('message', 'Sub Category has been deleted successfully!');
    }

    public function render()
    {
        $categories = Category::paginate(12);

        return view('livewire.admin.admin-category-component', ['categories' => $categories])->layout("layouts.base");
    }
}
