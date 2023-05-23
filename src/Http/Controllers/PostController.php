<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\Post;
use Hup234design\Cms\Models\PostCategory;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
        return view(View::exists('posts.index') ? 'posts.index' : 'cms::posts.index');
    }

    public function post($slug)
    {
        $post = Post::whereSlug($slug)->firstorFail();

        return view(View::exists('posts.post') ? 'posts.post' : 'cms::posts.post', [
            'post' => $post
        ]);
    }

    public function category($slug)
    {
        $category = PostCategory::whereSlug($slug)->firstorFail();

        return view(View::exists('posts.category') ? 'posts.category' : 'cms::posts.category', [
            'category' => $category
        ]);
    }
}
