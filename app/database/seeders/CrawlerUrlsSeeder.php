<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CrawlerUrlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crawler_urls')->insert([
            [
                'crawler_domain_name_id' => 1
            ]
        ]);
    }
}
