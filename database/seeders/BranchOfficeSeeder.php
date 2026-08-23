<?php

declare(strict_types=1);

namespace Database\Seeders;

use FuteBus\Core\Models\BranchOffice;
use FuteBus\Core\Models\BranchRegion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class BranchOfficeSeeder extends Seeder
{
    private const REGIONS = [
        'Miền Nam'   => ['slug' => 'mien-nam', 'en' => 'Southern Vietnam'],
        'Miền Trung' => ['slug' => 'mien-trung', 'en' => 'Central Vietnam'],
        'Tây Nguyên' => ['slug' => 'tay-nguyen', 'en' => 'Central Highlands'],
        'Miền Bắc'   => ['slug' => 'mien-bac', 'en' => 'Northern Vietnam'],
    ];

    public function run(): void
    {
        $records = $this->parseDirectory(database_path('seeders/data/branch-offices.txt'));

        DB::transaction(function () use ($records): void {
            $activeRegionIds = [];

            foreach (array_keys(self::REGIONS) as $regionOrder => $regionName) {
                $definition = self::REGIONS[$regionName];
                $region = BranchRegion::query()->updateOrCreate(
                    ['slug' => $definition['slug']],
                    [
                        'name'       => ['vi' => $regionName, 'en' => $definition['en']],
                        'is_active'  => true,
                        'sort_order' => $regionOrder + 1,
                    ],
                );
                $activeRegionIds[] = $region->id;

                $regionRecords = $records[$regionName] ?? [];
                $activeOfficeIds = [];

                foreach ($regionRecords as $officeOrder => $office) {
                    $branchOffice = BranchOffice::query()->updateOrCreate(
                        [
                            'branch_region_id' => $region->id,
                            'name->vi'         => $office['name'],
                            'address->vi'      => $office['address'],
                        ],
                        [
                            'name'       => ['vi' => $office['name'], 'en' => $office['name']],
                            'address'    => ['vi' => $office['address'], 'en' => $office['address']],
                            'phone'      => $office['phone'],
                            'map_query'  => $office['address'],
                            'is_active'  => true,
                            'sort_order' => $officeOrder + 1,
                        ],
                    );
                    $activeOfficeIds[] = $branchOffice->id;
                }

                $region->offices()->whereNotIn('id', $activeOfficeIds)->update(['is_active' => false]);
            }

            BranchRegion::query()->whereNotIn('id', $activeRegionIds)->update(['is_active' => false]);
        });
    }

    /**
     * @return array<string, list<array{name: string, address: string, phone: string}>>
     */
    private function parseDirectory(string $path): array
    {
        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new RuntimeException("Unable to read branch directory: {$path}");
        }

        $lines = array_values(array_filter(
            array_map('trim', preg_split('/\R/u', $contents) ?: []),
            static fn (string $line): bool => $line !== '',
        ));
        array_shift($lines);

        $records = [];
        $currentRegion = null;

        for ($index = 0; $index < count($lines);) {
            $line = $lines[$index];

            if (isset(self::REGIONS[$line])) {
                $currentRegion = $line;
                $records[$currentRegion] = [];
                $index++;

                continue;
            }

            if ($currentRegion === null || ($lines[$index + 2] ?? null) !== 'Tìm đường đi') {
                throw new RuntimeException("Invalid branch directory data near line: {$line}");
            }

            $records[$currentRegion][] = [
                'name'    => $line,
                'address' => $lines[$index + 1],
                'phone'   => $lines[$index + 3],
            ];
            $index += 4;
        }

        return $records;
    }
}
