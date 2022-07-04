<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listings = $request->user()->listings;

        return view('dashboard', compact('listings'));
    }
}
