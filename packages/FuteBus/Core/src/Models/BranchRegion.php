<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BranchRegion extends Model
{
    protected $fillable = ['slug', 'name', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'name'      => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function offices(): HasMany
    {
        return $this->hasMany(BranchOffice::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function localizedName(): string
    {
        return $this->name[app()->getLocale()] ?? $this->name['vi'] ?? '';
    }
}
