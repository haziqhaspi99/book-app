<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        // Creating 3 default clinic branches for testing
        Branch::create([
            'name' => 'Kuala Lumpur Clinic HQ',
            'location' => 'KL Sentral',
        ]);

        Branch::create([
            'name' => 'Shah Alam Branch',
            'location' => 'Seksyen 7',
        ]);

        Branch::create([
            'name' => 'Penang Island Retail Clinic',
            'location' => 'Georgetown',
        ]);
    }
}
