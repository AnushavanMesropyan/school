<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function adminView()
    {
        return view('admin.admin-view');
    }
}
