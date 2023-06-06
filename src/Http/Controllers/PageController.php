<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\IndexPage;
use Hup234design\Cms\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $page = IndexPage::whereFor('home')->firstorFail();

        return view('cms::pages.home', [
            'record' => $page
        ], );
    }

    public function page($slug): View
    {
        $page = Page::whereSlug($slug)->firstorFail();

        return view('cms::pages.page', [
            'record' => $page
        ]);
    }
}
