<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Slider\Slider;
use App\Models\StaticPage\StaticPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->take(3)->get();
        $ourVisionPage = StaticPage::where('slug', 'About-Village-Diet')->first();
        $aboutPage = StaticPage::where('slug', 'Our-Vision')->first();

        return view('website.pages.landing', compact('sliders', 'ourVisionPage', 'aboutPage'));
    }
}
