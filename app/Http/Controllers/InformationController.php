<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     *
     */
    public function privacyPolicy(Request $request)
    {
        return view('information.privacyPolicy');
    }

    /**
     *
     */
    public function termsOfUse(Request $request)
    {
        return view('information.termsOfUse');
    }
}
