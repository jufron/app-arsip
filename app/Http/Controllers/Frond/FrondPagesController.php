<?php

namespace App\Http\Controllers\Frond;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrondPagesController extends Controller
{
    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        // return view('welcome');
        return view('frond.index');
    }
}
