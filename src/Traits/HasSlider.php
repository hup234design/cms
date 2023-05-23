<?php

namespace Hup234design\Cms\Traits;

use Hup234design\Cms\Models\Slider;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasSlider
{
    /**
     * Get all of the sliders for the post.
     */
    public function sliders(): MorphToMany
    {
        return $this->morphToMany(Slider::class, 'slideable');
    }
}
