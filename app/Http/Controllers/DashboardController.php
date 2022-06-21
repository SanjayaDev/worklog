<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return $this->view_admin("index", "Dashboard", [], TRUE);
    }
}
