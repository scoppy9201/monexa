<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqCategory extends Model
{
    protected $fillable = ['slug', 'name', 'description', 'image', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'name'        => 'array',
            'description' => 'array',
            'is_active'   => 'boolean',
        ];
    }

    public function questions(): HasMany
    {
        return $this->hasMany(FaqQuestion::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function localized(string $field): string
    {
        $value = $this->{$field} ?? [];

        return $value[app()->getLocale()] ?? $value['vi'] ?? '';
    }
}
