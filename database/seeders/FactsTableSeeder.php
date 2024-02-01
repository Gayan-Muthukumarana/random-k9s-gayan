<?php

namespace Database\Seeders;

use App\Models\Fact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Storage::disk('local')->exists('facts-list.json')) {
            $jsonContents = Storage::disk('local')->get('facts-list.json');
            $data = json_decode($jsonContents, true);

            $now = Carbon::now();

            foreach ($data as $fact) {
                $description = $fact['fact'];

                Fact::updateOrInsert(
                    ['description' => $description],
                    [
                        'uuid' => Str::uuid(),
                        'description' => $description,
                        'is_contain_numbers' => preg_match('/\d/', $description),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        } else {
            echo "File not found!";
        }
    }
}
