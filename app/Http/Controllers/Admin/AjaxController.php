<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State\State;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function fetchState(Request $request)
    {
        $data['states'] = State::where('country_id', $request->country_id)
            ->join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');

        return response()->json($data['states']);
    }
}
