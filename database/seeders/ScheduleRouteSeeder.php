<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleRouteSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('bus_companies')->where('code', 'FUTA')->value('id');

        if (! $companyId) {
            $companyId = DB::table('bus_companies')->insertGetId([
                'name'       => 'FUTA Bus Lines',
                'code'       => 'FUTA',
                'hotline'    => '1900 6067',
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($this->groups() as $groupIndex => $routes) {
            foreach ($routes as $routeIndex => $route) {
                $sequence = ($groupIndex * 16) + $routeIndex + 1;

                DB::table('routes')->updateOrInsert(
                    ['code' => sprintf('SCHEDULE-%04d', $sequence)],
                    [
                        'bus_company_id'     => $companyId,
                        'name'               => $route['from'].' - '.$route['to'],
                        'origin_city'        => $route['from'],
                        'destination_city'   => $route['to'],
                        'distance_km'        => $route['distance'],
                        'duration_minutes'   => $route['hours'] * 60,
                        'vehicle_type'       => $route['vehicle'] ?: null,
                        'schedule_group'     => $groupIndex + 1,
                        'sort_order'         => $routeIndex + 1,
                        'is_public_schedule' => true,
                        'base_price'         => 0,
                        'is_active'          => true,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ],
                );
            }
        }
    }

    private function groups(): array
    {
        $initialGroups = [
            [
                ['from' => 'Da Nang traco', 'to' => 'Mien Dong Moi', 'vehicle' => 'Limousine', 'distance' => 85, 'hours' => 21],
                ['from' => 'Mien Tay', 'to' => 'Quy Nhon', 'vehicle' => 'Limousine', 'distance' => 87, 'hours' => 11],
                ['from' => 'Da Lat', 'to' => 'Da Nang', 'vehicle' => 'Limousine', 'distance' => 60, 'hours' => 14],
                ['from' => 'Cam Ranh', 'to' => 'Da Nang', 'vehicle' => 'Limousine', 'distance' => 46, 'hours' => 14],
                ['from' => 'Nha Trang BXB', 'to' => 'Da Nang', 'vehicle' => 'Limousine', 'distance' => 46, 'hours' => 12],
                ['from' => 'Nha Trang (BXN)', 'to' => 'Da Nang', 'vehicle' => 'Limousine', 'distance' => 46, 'hours' => 11],
                ['from' => 'Da Lat', 'to' => 'Hue', 'vehicle' => 'Limousine', 'distance' => 60, 'hours' => 16],
                ['from' => 'Bao Loc', 'to' => 'Hue', 'vehicle' => 'Limousine', 'distance' => 44, 'hours' => 18],
                ['from' => 'Bao Loc', 'to' => 'Hue (Quang Dien)', 'vehicle' => 'Limousine', 'distance' => 44, 'hours' => 20],
                ['from' => 'Bao Loc', 'to' => 'Da Nang', 'vehicle' => 'Limousine', 'distance' => 44, 'hours' => 16],
                ['from' => 'An Suong', 'to' => 'Quang Ngai', 'vehicle' => 'Limousine', 'distance' => 90, 'hours' => 15],
                ['from' => 'Da Lat', 'to' => 'Quang Ngai', 'vehicle' => 'Limousine', 'distance' => 60, 'hours' => 11],
                ['from' => 'Nga Tu Ga', 'to' => 'Quang Ngai', 'vehicle' => 'Limousine', 'distance' => 85, 'hours' => 16],
                ['from' => 'Nha Trang', 'to' => 'Hue', 'vehicle' => 'Limousine', 'distance' => 46, 'hours' => 12],
                ['from' => 'Bao Loc', 'to' => 'Quang Ngai', 'vehicle' => 'Limousine', 'distance' => 44, 'hours' => 13],
                ['from' => 'Mien Tay', 'to' => 'Quang Ngai', 'vehicle' => 'Limousine', 'distance' => 32, 'hours' => 15],
            ],
            [
                ['from' => 'Ca Mau (DT)', 'to' => 'Binh Duong (HCM)', 'vehicle' => 'Limousine', 'distance' => 20, 'hours' => 8],
                ['from' => 'Ca Mau', 'to' => 'Chau Doc', 'vehicle' => 'Limousine', 'distance' => 20, 'hours' => 7],
                ['from' => 'Can Tho', 'to' => 'Nam Can', 'vehicle' => 'Limousine', 'distance' => 38, 'hours' => 5],
                ['from' => 'Can Tho', 'to' => 'Ca Mau (DT)', 'vehicle' => 'Limousine', 'distance' => 57, 'hours' => 4],
            ],
            [
                ['from' => 'Hue', 'to' => 'Gia Lai', 'vehicle' => 'Limousine', 'distance' => 369, 'hours' => 12],
            ],
        ];

        return array_merge(
            $initialGroups,
            require database_path('seeders/data/schedule-routes.php'),
        );
    }
}
