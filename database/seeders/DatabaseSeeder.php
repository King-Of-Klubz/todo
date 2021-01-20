<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Team::factory(10)->create();

        DB::table('levels')->insert(
          [
              'title'=>'Low',
              'color'=>'green'
          ]
        );
        DB::table('levels')->insert(
            [
                'title'=>'Normal',
                 'color'=>'orange'
            ]
        );
        DB::table('levels')->insert(
            [
                'title'=>'High',
                'color'=>'red'
            ]
        );
    }
}
