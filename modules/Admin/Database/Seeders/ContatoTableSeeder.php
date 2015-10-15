<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ContatoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contatos')->insert([
            'email'         => 'email@safaricomunicacao.com',
            'telefone'      => '4933280101',
            'rua'           => 'Rua',
            'bairro'        => 'Centro',
            'cidade'        => 'Chapecó',
            'estado'        => 'SC',
            'numero'        => '152',
            'cep'           => '89800-000',
            'complemento'   => '',
            'latitude'      => '-27.1070315',
            'longitude'     => '-52.6119455',
            'facebook'      => 'safaricomunicacaooficial',
            'googleplus'    => '',
            'twitter'       => '',
            'instagran'     => '',
        ]);
    }
}
