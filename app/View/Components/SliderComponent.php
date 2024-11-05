<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Slider;

class SliderComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $sliders;
    public function __construct()
    {
        $this->sliders=Slider::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.slider-component');
    }
}
