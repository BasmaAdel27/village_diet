<?php

namespace Database\Seeders;

use App\Models\Day\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $initData = include database_path('init_data/days.php');

        for ($i = 0; $i <= 30; $i++) {
            $data['number'] = $i + 1;
            $data['ar']['title']   = $initData[$i]['name_ar'];
            $data['en']['title']   = $initData[$i]['name_en'];

            Day::create($data);
        }
    }
}
