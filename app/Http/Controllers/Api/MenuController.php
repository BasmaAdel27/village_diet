<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MenuResource;
use App\Models\Setting;
use App\Models\StaticPage\StaticPage;
use Illuminate\Http\Request;
use stdClass;

class MenuController extends Controller
{
    public function index()
    {
        $obj = new stdClass;
        $obj->staticPages = StaticPage::where('is_show_in_app', true)
            ->where('is_active', true)
            ->with('translations')
            ->get();
        $obj->settings = Setting::select(
            ['facebook', 'twitter', 'youtube', 'snapchat', 'tiktok', 'instagram']
        )->get();

        return successResponse(MenuResource::make($obj));
    }
}
