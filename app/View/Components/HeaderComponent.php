<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Menu;
use App\Models\Update;

class HeaderComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuItems,$updates;
    public function __construct()
    {

        $this->menuItems = Menu::with('submenus')->whereNull('parent_id')->get();
        $this->updates = Update::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-component');
    }
}
