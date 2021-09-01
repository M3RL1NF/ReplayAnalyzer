<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'name' => 'crawler',
                'description' => 'Runs the crawler',
                'frequency' => '*/1 * * * *',
                'enabled' => 1
            ]
        ]);
    }
}
