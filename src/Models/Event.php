<?php

namespace Hup234design\Cms\Models;

use Awcodes\Curator\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Event extends Model
{
    use HasFactory;
    use HasSEO;

    protected $guarded = [];

    protected $casts = [
        'content_blocks' => 'array',
        'published' => 'boolean',
        'date' => 'datetime:Y-m-d',
    ];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            //image: $this->seoImage?->getUrl('seo'),
        );
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function featured_image() : BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function seo_image() : BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('date', '>=', Carbon::now());
    }

    public function scopePrevious($query)
    {
        return $query->whereDate('date', '<', Carbon::now());
    }

    protected static function boot()
    {
        parent::boot();

        // Order by home page and then by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }
}
