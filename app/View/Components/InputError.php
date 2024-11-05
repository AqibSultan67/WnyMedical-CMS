<?php
namespace App\View\Components;

use Illuminate\View\Component;

class InputError extends Component
{
    public $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function render()
    {
        return view('components.input-error');
    }
}
