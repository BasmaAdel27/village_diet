<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\VideoDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Day\Day;
use App\Models\Video\Video;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.videos.index')->only(['index']);
        $this->middleware('permission:admin.videos.store')->only(['store']);
        $this->middleware('permission:admin.videos.update')->only(['update']);
        $this->middleware('permission:admin.videos.destroy')->only(['destroy']);
    }

    public function index(VideoDatatable $videoDatatable)
    {
        return $videoDatatable->render('admin.videos.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');
        $days    = Day::join('day_translations', 'days.id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->select('title', 'days.id')
            ->pluck('title', 'id');

        return view('admin.videos.create', compact('locales', 'days'));
    }


    public function store(VideoRequest $request, Video $video)
    {
        $data = $request->validated();
        $video->fill($data)->save();

        return redirect()->route('admin.videos.index')->with('success', trans('created_successfully'));
    }

    public function edit(Video $video)
    {
        $locales = config('translatable.locales');
        $days    = Day::join('day_translations', 'days.id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->select('title', 'days.id')
            ->pluck('title', 'id');

        return view('admin.videos.edit', compact('locales', 'days', 'video'));
    }

    public function update(VideoRequest $request, Video $video)
    {
        $data = $request->validated();
        $video->fill($data)->save();

        return redirect()->route('admin.videos.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', trans('deleted_successfully'));
    }
}
