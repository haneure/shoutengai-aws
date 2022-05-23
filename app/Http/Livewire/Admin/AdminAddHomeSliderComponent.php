<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;

    public function mount() {
        $this->status = 0;
    }

    public function update($fields) {
        $this->validateOnly($fields, [
            'link' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
    }

    public function addSlide() {
        $this->validate([
            'link' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;

        $imagename = Carbon::now()->timestamp . '.' . $this->image->extension();
        // $this->image->storeAs('sliders', $imagename);
        // $slider->image = $imagename;

        //Add to s3
        $path = $this->image->storeAs('sliders', $imagename, 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $slider->image = Storage::disk('s3')->url($path);

        $slider->status = $this->status;
        $slider->save();
        session()->flash('message', 'Slide has been added successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
