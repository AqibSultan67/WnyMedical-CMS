<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownLink extends Component
{
    public $href;
    public $label;

    public function __construct($href, $label)
    {
        $this->href = $href;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.dropdown-link');
    }
}
