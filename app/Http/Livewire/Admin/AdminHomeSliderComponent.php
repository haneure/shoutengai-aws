<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{
    public function deleteSlide($slide_id){
        $slider = HomeSlider::find($slide_id);

        if(strpos($slider->image, 'http') !== false){
            $image_format = explode('/', $slider->image);
            $image_format = end($image_format);
            Storage::disk('s3')->delete('sliders/'.$image_format);
        } else {
            unlink('assets/images/sliders'.'/'.$slider->image);
        }

        $slider->delete();
        session()->flash('message', 'Slide has been deleted successfully');
    }

    public function render()
    {
        $sliders = HomeSlider::all();
        return view('livewire.admin.admin-home-slider-component', ['sliders'=>$sliders])->layout('layouts.base');
    }
}
