<?php
namespace App\View\Components;

use Illuminate\View\Component;

class InputLabel extends Component
{
    public $label;

    public function __construct($label)
    {
        $this->label = $label;
    }

    public function render()
    {
        return view('components.input-label');
    }
}