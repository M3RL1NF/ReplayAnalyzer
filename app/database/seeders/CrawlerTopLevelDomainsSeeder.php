<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CrawlerTopLevelDomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crawler_top_level_domains')->insert([
            [
                'name' => 'eu',
                'crawler_domain_name_id' => 1,
                'enabled' => '1'
            ],
            [
                'name' => 'ru',
                'crawler_domain_name_id' => 1,
                'enabled' => '0'
            ]
        ]);
    }
}
