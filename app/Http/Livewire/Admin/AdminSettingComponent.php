<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingComponent extends Component
{
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $map;
    public $twitter;
    public $instagram;
    public $linkedin;
    public $github;
    public $youtube;

    public function mount() {
        $setting = Setting::find(1);
        if($setting){
            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->phone2 = $setting->phone2;
            $this->address = $setting->address;
            $this->map = $setting->map;
            $this->twitter = $setting->twitter;
            $this->instagram = $setting->instagram;
            $this->linkedin = $setting->linkedin;
            $this->github = $setting->github;
            $this->youtube = $setting->youtube;
        }
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'email' => 'required|email',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'map' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'github' => 'required',
            'youtube' => 'required'
        ]);
    }

    public function saveSettings() {
        $this->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'map' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'github' => 'required',
            'youtube' => 'required'
        ]);

        $setting = Setting::find(1);
        if(!$setting) {
            $setting = new Setting();
        }
        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->phone2 = $this->phone2;
        $setting->address = $this->address;
        $setting->map = $this->map;
        $setting->twitter = $this->twitter;
        $setting->instagram = $this->instagram;
        $setting->linkedin = $this->linkedin;
        $setting->github = $this->github;
        $setting->youtube = $this->youtube;
        $setting->save();
        session()->flash('message', 'Settings has been saved successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
