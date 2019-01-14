<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function demo($demopage = 'index')
    {
        return view('admin.' . $demopage)->with(['page' => $demopage]);
    }

    public function index()
    {
        return view('admin.index');
    }
}
