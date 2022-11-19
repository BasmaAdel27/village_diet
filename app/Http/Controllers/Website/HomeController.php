<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Slider\Slider;
use App\Models\StaticPage\StaticPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->latest()->take(3)->get();
        $ourVisionPage = StaticPage::where('is_active', true)->where('slug', 'About-Village-Diet')->first();
        $aboutPage = StaticPage::where('is_active', true)->where('slug', 'Our-Vision')->first();
        $workWaySteps = Service::where('is_active', true)->where('type', 'WorkWay')->oldest('ordering')->get();
        $products = Service::where('is_active', true)->where('type', 'Store')->oldest('ordering')->get();

        return view('website.pages.landing', compact(
            'sliders',
            'ourVisionPage',
            'aboutPage',
            'workWaySteps',
            'products'
        ));
    }
}
