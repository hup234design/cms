<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\IndexPage;
use Hup234design\Cms\Models\Page;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home()
    {
        $page = IndexPage::whereFor('home')->firstorFail();

        return view(View::exists('pages.home') ? 'pages.home' : 'cms::pages.home', [
            'page' => $page
        ]);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->firstorFail();

        return view(View::exists('pages.page') ? 'pages.page' : 'cms::pages.page', [
            'page' => $page
        ]);
    }
}
