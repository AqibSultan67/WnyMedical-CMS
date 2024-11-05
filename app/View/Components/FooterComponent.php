<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Footer;
use App\Models\Info;

class FooterComponent extends Component
{
    public $info;
    public $footer;

    public function __construct()
    {
        $this->info = Info::first();
        $this->footer = Footer::first();
    }

    public function render()
    {
        return view('components.footer-component');
    }
}
