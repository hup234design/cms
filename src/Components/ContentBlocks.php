<?php

namespace Hup234design\Cms\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentBlocks extends Component
{
    protected $blocks;
    /**
     * Create a new component instance.
     */
    public function __construct($blocks = [])
    {
        $this->blocks = $blocks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('cms::components.content-blocks', [
            'blocks' => $this->blocks
        ]);
    }
}
