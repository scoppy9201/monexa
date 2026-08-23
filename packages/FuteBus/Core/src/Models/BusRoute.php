<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    protected $table = 'routes';

    protected $fillable = [
        'bus_company_id',
        'code',
        'name',
        'origin_city',
        'origin_station',
        'destination_city',
        'destination_station',
        'distance_km',
        'duration_minutes',
        'vehicle_type',
        'schedule_group',
        'sort_order',
        'is_public_schedule',
        'base_price',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'distance_km'        => 'integer',
            'duration_minutes'   => 'integer',
            'schedule_group'     => 'integer',
            'sort_order'         => 'integer',
            'is_public_schedule' => 'boolean',
            'base_price'         => 'decimal:2',
            'is_active'          => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeScheduleOrder(Builder $query): Builder
    {
        return $query->orderBy('schedule_group')->orderBy('sort_order')->orderBy('id');
    }

    public function scopePublicSchedule(Builder $query): Builder
    {
        return $query->where('is_public_schedule', true);
    }
}
