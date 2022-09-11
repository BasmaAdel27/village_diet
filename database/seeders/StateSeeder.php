<?php

namespace Database\Seeders;

use App\Models\State\State;
use App\Models\State\StateTranslation;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run()
    {
        $satets = include database_path('init_data/state.php');
        foreach ($satets as $state) {
            State::create($state);
        }
    }
}
