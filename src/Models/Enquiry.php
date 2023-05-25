<?php

namespace Hup234design\Cms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'subject',
        'message',
        'terms',
        'ip_address',
        'domain',
        'spam'
    ];

    public function getNameAttribute() {
        return $this->first_name . " " . $this->last_name;
    }

    public function scopeSpam($query) {
        return $query->where('spam', true);
    }

    public function scopeNotSpam($query) {
        return $query->where('spam', false);
    }

    public function blockIP()
    {
        EnquiryBlock::create([
            'blockable_type' => get_class($this),
            'blockable_id' => $this->id,
            'type' => 'ip_address',
            'value' => $this->ip_address,
        ]);
    }

    public function blockEmail()
    {
        $emailParts = explode('@', $this->email);
        $emailDomain = end($emailParts);

        EnquiryBlock::create([
            'blockable_type' => get_class($this),
            'blockable_id' => $this->id,
            'type' => 'email',
            'value' => $this->email,
        ]);

        EnquiryBlock::create([
            'blockable_type' => get_class($this),
            'blockable_id' => $this->id,
            'type' => 'email_domain',
            'value' => $emailDomain,
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        // Order by home page then sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });

        // when saved update home page flag
        static::saved(function ($model) {
            if ($model->spam) {

                EnquiryBlock::firstOrCreate([
                    'type' => 'ip_address',
                    'value' => $model->ip_address,
                ]);

                EnquiryBlock::firstOrCreate([
                    'type' => 'email',
                    'value' => $model->email,
                ]);

                EnquiryBlock::firstOrCreate([
                    'type' => 'domain',
                    'value' => $model->domain,
                ]);

            }
        });

    }
}
