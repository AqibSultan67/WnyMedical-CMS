<?php
namespace App\View\Components;

use Illuminate\View\Component;

class PrimaryButton extends Component
{
    public $label;
    public $type;

    public function __construct($label, $type = 'button')
    {
        $this->label = $label;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.primary-button');
    }
}
