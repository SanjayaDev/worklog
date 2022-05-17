<?php

namespace App\View\Components\Layouts\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class App extends Component
{
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = "Dashboard")
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = [
            "is_su" => Auth::user()->is_super_admin
        ];

        return view('components.layouts.admin.app', $data);
    }
}
