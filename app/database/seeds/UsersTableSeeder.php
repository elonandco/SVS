<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

         DB::table('users')->insert(array(
         	array(
                'email'      => 'admin',
                'password'   => Hash::make('admin'),
                'confirmed'  => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
         ));

    }
}