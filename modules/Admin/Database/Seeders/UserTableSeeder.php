<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'        => 1,
            'name'      => 'Master',
            'email'     => 'master@safaricomunicacao.com',
            'password'  => bcrypt('safari@123'),
        ]);

        DB::table('users')->insert([
            'id'        => 2,
            'name'      => 'Administrador',
            'email'     => 'admin@safaricomunicacao.com',
            'password'  => bcrypt('admin@123'),
        ]);
    }
}
