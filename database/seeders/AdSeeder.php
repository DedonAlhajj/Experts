<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            for ($i = 1; $i <= 20; $i++) {
                $start = Carbon::now()->subDays(rand(0, 10));
                $end = $start->copy()->addDays(rand(5, 20));

                Ad::create([
                    'title' => 'title ' . $i,
                    'description' => 'description ' . $i,
                    'position' => collect(['header', 'sidebar', 'footer', 'inline'])->random(),
                    'is_active' => rand(0, 1),
                    'start_at' => $start,
                    'end_at' => $end,
                    'clicks' => rand(0, 500),
                    'link' => 'https://example.com/ad/' . $i,
                ]);
            }
        });
    }
}
