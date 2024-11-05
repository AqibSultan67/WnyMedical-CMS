<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Content;

class ContentComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $homeContent;
    public function __construct()
    {
        $this->homeContent=Content::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-component');
    }
}
