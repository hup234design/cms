<?php

namespace Hup234design\Cms\Models;

use Hup234design\Cms\Traits\HasSlider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class IndexPage extends Model implements Sortable
{
    use HasFactory;
    use HasSEO;
    use SortableTrait;
    use HasSlider;

    protected $guarded = [];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'header_blocks' => 'array',
        'visible' => 'boolean',
    ];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            //image: $this->seoImage?->getUrl('seo'),
        );
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
