<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqQuestion extends Model
{
    protected $fillable = ['faq_category_id', 'question', 'answer', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'question' => 'array',
            'answer' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function localizedQuestion(): string
    {
        return $this->question[app()->getLocale()] ?? $this->question['vi'] ?? '';
    }

    public function localizedAnswer(): array
    {
        return $this->answer[app()->getLocale()] ?? $this->answer['vi'] ?? [];
    }
}
