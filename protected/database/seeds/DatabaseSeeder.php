<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
		Eloquent::unguard();
		
		// $this->call('UserTableSeeder');

		# Kita akan beri nama Seeder dengan 'SeederRelasi'
		//$this->call('SeederRelasi');
		//$this->call(relasiTableSeeder::class);
		$this->call(PegawaiTableSeeder::class);
		# Tampilkan informasi berikut bila Seeder telah dilakukan
		$this->command->info('SeederRelasi berhasil.');
		
    }
}
