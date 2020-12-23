<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CrawlerDomainNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crawler_domain_names')->insert(
            [
                'name' => 'wotreplays'
            ]
        );
    }
}
