<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ConfiguracaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracao')->insert([
            'logo'          => 'logo.png',
            'logo_footer'   => 'logo_footer.png',
            'nome_site'     => 'SafariADM',
        ]);
    }
}
