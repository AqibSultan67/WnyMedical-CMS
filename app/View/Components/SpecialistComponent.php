<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Specialist;

class SpecialistComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $specialists;
    public function __construct()
    {
        $this->specialists=Specialist::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.specialist-component');
    }
}
