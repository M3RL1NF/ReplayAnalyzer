<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CrawlerParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crawler_parameters')->insert([
            [
                'name' => 'stats',
                'crawler_domain_name_id' => 1
            ],
            [
                'name' => 'teams',
                'crawler_domain_name_id' => 1
            ],
            [
                'name' => 'details',
                'crawler_domain_name_id' => 1
            ]
        ]);
    }
}
