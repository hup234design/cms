<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('cms::home');
    }

    public function page($slug): View
    {
        $page = Page::whereSlug($slug)->firstorFail();

        return view('cms::page', [
            'page' => $page
        ]);
    }
}
