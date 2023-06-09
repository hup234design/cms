<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class EventCategory extends Model implements Sortable
{
    use HasFactory;
    use HasSEO;
    use SortableTrait;

    protected $guarded = [];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            //image: $this->seoImage?->getUrl('seo'),
        );
    }

    public function events() : HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function published_upcoming_events() : HasMany
    {
        return $this->events()->published()->upcoming();
    }

    protected static function boot()
    {
        parent::boot();

        // Order by home page and then by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }
}
