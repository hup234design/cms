<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Download extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $guarded = [];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];


    protected static function boot()
    {
        parent::boot();

        // Order by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });

        static::deleting(function($download) {
            Storage::delete('public/' .  $download['file_name']);
        });

    }


}
