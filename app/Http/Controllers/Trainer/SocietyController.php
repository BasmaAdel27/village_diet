<?php

namespace App\Http\Controllers\Trainer;

use App\DataTables\Trainer\SocietyDatatable;
use App\Http\Controllers\Controller;
use App\Models\Chat\SocietyChat;
use App\Models\SeenMessage;
use App\Models\Society\Society;

class SocietyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:trainer.societies.index')->only(['index']);
        $this->middleware('permission:trainer.societies.show')->only(['show']);
    }

    public function index(SocietyDatatable $societyDatatable)
    {
        return  $societyDatatable->render('trainer.society.index');
    }

    public function show(Society $society)
    {
        $society->loadCount('users')->load(['trainer', 'translations']);

        return  view('trainer.society.show', compact('society'));
    }


}
