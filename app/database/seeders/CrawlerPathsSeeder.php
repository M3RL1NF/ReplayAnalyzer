<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CrawlerPathsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crawler_paths')->insert([
            [
                'name' => 'site',
                'crawler_domain_name_id' => 1
            ]
        ]);
    }
}
