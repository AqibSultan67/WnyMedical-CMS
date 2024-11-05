<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\AboutImage;

class AboutComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $images;
    public function __construct()
    {
        $this->images=AboutImage::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.about-component');
    }
}
