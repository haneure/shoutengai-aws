<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $newimage;
    public $slider_id;

    public function mount($slide_id) {
        $slider = HomeSlider::find($slide_id);
        $this->title = $slider-> title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->status = $slider->status;
        $this->slider_id = $slider->id;
    }

    public function updateSlide() {
        $slider = HomeSlider::find($this->slider_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;

        if($this->newimage)
        {
            if(strpos($slider->image, 'http') !== false){
                $image_format = explode('/', $slider->image);
                $image_format = end($image_format);
                Storage::disk('s3')->delete('sliders/'.$image_format);
            } else {
                unlink('assets/images/sliders'.'/'.$slider->image);
            }

            $imagename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            // $this->newimage->storeAs('sliders', $imagename);
            // $slider->image = $imagename;

            //add to s3
            $path = $this->newimage->storeAs('sliders', $imagename, 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $slider->image = Storage::disk('s3')->url($path);
        }

        $slider->status = $this->status;
        $slider->save();
        session()->flash('message', 'Slide has been edited successfully');

    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
