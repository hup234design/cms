<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Models\Post;
use Hup234design\Cms\Models\PostCategory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostsLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('cms::layouts.posts', [
            'latest_posts' => Post::published()->get()->take(5),
            'categories' => PostCategory::withCount('published_posts')->get()
        ]);
    }
}
