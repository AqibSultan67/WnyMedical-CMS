<?php
namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Practice;

class PracticeComponent extends Component
{
    public $practice;

    public function __construct()
    {

        $this->practice = Practice::first();
    }

    public function render(): View|Closure|string
    {

        return view('components.practice-component', [
            'practice' => $this->practice,
        ]);
    }
}
