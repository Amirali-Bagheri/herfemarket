<?php

namespace Modules\Setting\Http\Livewire\Admin;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Core\Http\Livewire\BaseComponent;
use Modules\Setting\Entities\Setting;
use Throwable;

class Settings extends BaseComponent
{
    use WithPagination;
    use WithFileUploads;

    public $keys = [];

    public function mount()
    {
        foreach (Setting::all() as $setting) {
            try {
                $this->keys[$setting->key] = $setting->value;
            } catch (Throwable $exception) {
                $this->keys[$setting->key] = null;
            }
        }
    }

    public function submit()
    {
        foreach ($this->keys as $key => $value) {
            Setting::set($key, $value);
        }
        // dd($this->keys);

        // $keys = request()->except('_token');
        //
        // foreach ($keys as $key => $value) {
        //     if (request()->hasFile($key)) {
        //         // request()->file($key)->move('uploads', request()->file($key)->getClientOriginalName());
        //         // return request()->file($key)->getClientOriginalName();
        //
        //         // return $value;
        //         $file           = request()->file($key);
        //         $basename       = $file->getClientOriginalName(); // get the original filename + extension
        //         $extension      = $file->getClientOriginalExtension(); // get the original extension without the dot
        //         $filename       = basename($basename, '.' . $extension); // get the original filename only
        //         $slug           = Str::slug($filename, '-'); // slug the original filename
        //         $upload_success = $file->move('uploads', $slug . '.' . $extension);
        //         Setting::set($key, $slug . '.' . $extension);
        //     } else {
        //         Setting::set($key, $value);
        //     }
        // }

        $this->alert('success', 'عملیات با موفقیت انجام شد', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('setting::livewire.admin.settings')->extends('admin.layouts.master', [
            'pageTitle' => 'تنظیمات',
        ]);
    }
}
