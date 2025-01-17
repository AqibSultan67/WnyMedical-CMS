<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SecondaryButton extends Component
{
    public $label;
    public $href;

    public function __construct($label, $href = '#')
    {
        $this->label = $label;
        $this->href = $href;
    }

    public function render()
    {
        return view('components.secondary-button');
    }
}
