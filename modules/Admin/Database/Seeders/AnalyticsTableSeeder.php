<?php
namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AnalyticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('analytics')->insert([
            'codigo' => 'UA-1243SARR'
        ]);
    }
}
