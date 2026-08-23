<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
    protected $fillable = [
        'name_vi',
        'name_en',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function articles(): HasMany
    {
        return $this->hasMany(NewsArticle::class);
    }

    public function localizedName(): string
    {
        return app()->getLocale() === 'en' ? $this->name_en : $this->name_vi;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
