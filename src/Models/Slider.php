<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function slides() : HasMany
    {
        return $this->hasMany(Slide::class);
    }

    /**
     * Get all of the pages that are assigned this slider.
     */
    public function pages(): MorphToMany
    {
        return $this->morphedByMany(Page::class, 'slideable');
    }
}
