<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Portal;

class PortalComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $portals;
    public function __construct()
    {
        $this->portals=Portal::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portal-component');
    }
}
