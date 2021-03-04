<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoonController extends Controller
{
    public function soon()
    {
        return view('site.soon');
    }
}
