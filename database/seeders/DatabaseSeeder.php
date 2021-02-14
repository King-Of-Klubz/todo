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
        Team::factory(3)->create();

        DB::table('levels')->insert(
          [
              'title'=>'Low',
              'color'=>'bg-green-100 text-green-800 '
          ]
        );

        DB::table('levels')->insert(
            [
                'title'=>'High',
                'color'=>'bg-red-100 text-red-800'
            ]
        );
    }
}
