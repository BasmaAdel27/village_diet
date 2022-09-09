<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RatingDatatable;
use App\Http\Controllers\Controller;


class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.ratings.index');
    }

    public function __invoke(RatingDatatable $ratingDatatable)
    {
        return $ratingDatatable->render('admin.ratings.index');
    }
}
