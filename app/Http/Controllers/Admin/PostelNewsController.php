<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PostelNewsDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostalNewsRequest;
use App\Mail\SubscriberMail;
use App\Models\Subscriber;
use App\Models\Template\Template;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PostelNewsController extends Controller
{

    public function index(PostelNewsDatatable $postelNewsDatatable)
    {
        return $postelNewsDatatable->render('admin.postel_news.index');
    }

    public function create()
    {
        $users = Subscriber::pluck('email');
        $templates = Template::join('template_translations', 'templates.id', 'template_translations.template_id')
            ->where('locale', app()->getLocale())
            ->select('subject', 'templates.id')
            ->pluck('subject', 'id');

        return view('admin.postel_news.create', compact('users', 'templates'));
    }

    public function store(PostalNewsRequest $request)
    {
        $data = $request->validated();

        foreach ($data['emails'] as $email) {
            Mail::to($email)->send(new SubscriberMail(
                $email,
                Template::find($data['template'])
            ));
        }

        return redirect()->route('admin.postel_news.index')->with('success', trans('send_successfully'));
    }

    public function destroy($id)
    {
        Subscriber::find($id)->delete();

        return redirect()->route('admin.postel_news.index')->with('success', trans('deleted_successfully'));
    }
}
