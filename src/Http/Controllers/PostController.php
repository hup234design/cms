<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\Post;
use Hup234design\Cms\Models\PostCategory;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('cms::posts.index');
    }

    public function post($slug): View
    {
        $post = Post::whereSlug($slug)->firstorFail();

        return view('cms::posts.post', [
            'record' => $post
        ]);
    }


    public function category($slug): View
    {
        $category = PostCategory::whereSlug($slug)->firstorFail();

        return view('cms::posts.category', [
            'category' => $category
        ]);
    }
}
