<?php

namespace Modules\Advert\View\Components;

use Illuminate\View\Component;

class Banner extends Component
{
    public $url;
    public $image;
    public $alt;
    public $class;

    public function __construct($url, $image, $alt, $class)
    {
        $this->image = $image;
        $this->alt = $alt;
        $this->url = $url;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.banner');
    }
}
