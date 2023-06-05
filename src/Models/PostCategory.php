<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RalphJSmit\Helpers\Laravel\Concerns\HasFactory;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class PostCategory extends Model implements Sortable
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

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function published_posts() : HasMany
    {
        return $this->posts()->published();
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
